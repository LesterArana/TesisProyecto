<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollDetailsExport implements FromCollection, WithHeadings
{
    protected $payrollId;

    public function __construct($payrollId)
    {
        $this->payrollId = $payrollId;
    }

    public function collection()
    {
        $payroll = Payroll::with('details.employee.person')->find($this->payrollId);

        return $payroll->details->map(function ($detail) {
            return [
                'Empleado' => $detail->employee->person->name,
                'Días Trabajados' => $detail->worked_days,
                'Horas Totales' => $detail->total_hours,
                'Horas Extras Diurnas' => $detail->daytime_overtime,
                'Horas Extras Nocturnas' => $detail->night_overtime,
                'Salario Base' => $detail->base_salary,
                'Deducciones' => $detail->deductions,
                'Deducciones de Prestamos' => $detail->deductions_credits,
                'Bonificaciones' => $detail->bonuses,
                'Pago Neto' => $detail->net_pay,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Empleado',
            'Días Trabajados',
            'Horas Totales',
            'Horas Extras Diurnas',
            'Horas Extras Nocturnas',
            'Salario Base',
            'Deducciones',
            'Deducciones de Prestamos',
            'Bonificaciones',
            'Pago Neto',
        ];
    }
}
