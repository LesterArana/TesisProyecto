<?php

namespace App\Livewire\Payrolls;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Assist;
use App\Models\NumberOfHour;
use App\Models\FixedPayment;
use App\Models\Credit;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;


class GeneratePayroll extends Component
{
    public $start_date;
    public $end_date;
    public $payment_type = 'mensual'; // Valor por defecto

    protected $rules = [
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'payment_type' => 'required|in:mensual,quincenal',
    ];

    public function createPayroll()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $existingPayroll = Payroll::where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                    ->orWhere(function ($query) {
                        $query->where('start_date', '<=', $this->start_date)
                            ->where('end_date', '>=', $this->end_date);
                    });
            })->exists();

            if ($existingPayroll) {
                $this->dispatch('mostrarAlertaError', 'El rango de fechas seleccionado ya está cubierto por otra nómina.');

                return;
            }

            $employees = Employee::with('position')->get();
            $totalAmount = 0;

            $fixedPayment = FixedPayment::first();
            $bonuses = $fixedPayment ? $fixedPayment->bonus_incentive : 0;
            $deductionsRate = $fixedPayment ? $fixedPayment->subject_to_iggs_payment : 0.1;

            $payroll = Payroll::create([
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_amount' => 0,
                'payment_type' => $this->payment_type, // Guardamos el tipo de pago
                'user_id' => auth()->id(),
            ]);

            foreach ($employees as $employee) {
                $baseSalary = $employee->position->salary;

                $workingDays = collect(range(
                    strtotime($this->start_date),
                    strtotime($this->end_date),
                    86400
                ))->filter(function ($date) {
                    return !in_array(date('N', $date), [6, 7]); // Excluir sábados y domingos
                })->count();

                if ($this->payment_type === 'quincenal') {
                    $baseSalary /= 2;
                }

                $dailySalary = $baseSalary / $workingDays;

                $daysWorked = Assist::where('employee_id', $employee->id)
                    ->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->distinct('start_date')
                    ->count();

                $workedSalary = $dailySalary * $daysWorked;

                $deductions = $deductionsRate;

                $daytimeOvertime = NumberOfHour::where('employee_id', $employee->id)
                    ->whereBetween('date', [$this->start_date, $this->end_date])
                    ->where('type_of_hours', 0)
                    ->sum('amount');

                $nightOvertime = NumberOfHour::where('employee_id', $employee->id)
                    ->whereBetween('date', [$this->start_date, $this->end_date])
                    ->where('type_of_hours', 1)
                    ->sum('amount');

                $daytimeOvertimePay = $daytimeOvertime * $employee->position->daytime_overtime;
                $nightOvertimePay = $nightOvertime * $employee->position->night_extra_hour;

                $creditDeduction = 0;
                $credits = Credit::where('employee_id', $employee->id)
                    ->where('remaining_amount', '>', 0)
                    ->get();

                foreach ($credits as $credit) {
                    $installmentAmount = $credit->amount / $credit->installments;

                    $credit->remaining_amount -= $installmentAmount;
                    $credit->save();

                    Payment::create([
                        'credit_id' => $credit->id,
                        'payroll_id' => $payroll->id,
                        'amount' => $installmentAmount,
                    ]);

                    $creditDeduction += $installmentAmount;
                }

                $netPay = $workedSalary + $daytimeOvertimePay + $nightOvertimePay + $bonuses - $deductions - $creditDeduction;

                $payroll->details()->create([
                    'employee_id' => $employee->id,
                    'base_salary' => $baseSalary,
                    'worked_days' => $daysWorked,
                    'total_hours' => $daysWorked * 8,
                    'daytime_overtime' => $daytimeOvertimePay,
                    'night_overtime' => $nightOvertimePay,
                    'deductions' => $deductions,
                    'deductions_credits' => $creditDeduction,
                    'bonuses' => $bonuses,
                    'net_pay' => $netPay,
                ]);

                $totalAmount += $netPay;
            }

            $payroll->update(['total_amount' => $totalAmount]);

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Nómina creada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('payrolls.index');
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('mostrarAlertaError', 'Hubo un error al crear la nómina: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.payrolls.generate-payroll');
    }
}

