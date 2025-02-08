<?php

namespace App\Livewire\Payrolls;

use App\Models\Payroll;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TablePayroll extends Component
{
    use WithPagination;

    protected $listeners = ['deletePayroll'];

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deletePayroll($payrollId)
    {
        DB::beginTransaction();

        try {
            $payroll = Payroll::find($payrollId);

            if ($payroll) {
                foreach ($payroll->details as $detail) {
                    $payments = Payment::where('payroll_id', $payroll->id)
                        ->whereHas('credit', function ($query) use ($detail) {
                            $query->where('employee_id', $detail->employee_id);
                        })
                        ->get();

                    foreach ($payments as $payment) {
                        $credit = $payment->credit;
                        $credit->remaining_amount += $payment->amount;
                        $credit->save();

                        $payment->delete();
                    }
                }

                $payroll->details()->delete();

                $payroll->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Nómina eliminada exitosamente y los pagos han sido revertidos!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('payrolls.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando la nómina: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('payrolls.index');
        }
    }

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'ASC';
        }
    }

    public function redirectToCreate()
    {
        return redirect()->route('payrolls.create')->with('status', 'redirect');
    }

    public function render()
    {
        $payrolls = Payroll::where('start_date', 'like', '%' . $this->search . '%')
            ->orWhere('end_date', 'like', '%' . $this->search . '%')
            ->orWhere('total_amount', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.payrolls.table-payroll', compact('payrolls'));
    }
}
