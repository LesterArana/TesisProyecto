<?php

namespace App\Livewire\Payrolls;

use App\Models\Payroll;
use Livewire\Component;
use App\Exports\PayrollDetailsExport;
use Maatwebsite\Excel\Facades\Excel;

class ShowPayroll extends Component
{
    public $payroll;

    public function mount(Payroll $payroll)
    {
        $this->payroll = $payroll->load(['details', 'user']);
    }
    public function export()
    {
        return Excel::download(new PayrollDetailsExport($this->payroll->id), 'detalles_nomina.xlsx');
    }

    public function render()
    {
        return view('livewire.payrolls.show-payroll', [
            'payroll' => $this->payroll,
        ]);
    }
}
