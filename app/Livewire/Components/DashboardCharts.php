<?php

namespace App\Livewire\Components;

use App\Models\Position;
use App\Models\Payroll;
use App\Models\TravelExpense;
use Carbon\Carbon;
use Livewire\Component;

class DashboardCharts extends Component
{
    public $positionNames = [];
    public $employeeCounts = [];
    public $payrollAmounts = [];
    public $travelExpenses = [];

    public function mount()
    {
        $positions = Position::with('employees')->where('status', 1)->get();
        foreach ($positions as $position) {
            $this->positionNames[] = $position->name;
            $this->employeeCounts[] = $position->employees->count();
        }

        $payrolls = Payroll::selectRaw('YEAR(start_date) as year, MONTH(start_date) as month, SUM(total_amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        foreach ($months as $num => $name) {
            $this->payrollAmounts[$name] = $payrolls->where('month', $num)->sum('total');
        }

        $travelExpenses = TravelExpense::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        foreach ($months as $num => $name) {
            $this->travelExpenses[$name] = $travelExpenses->where('month', $num)->sum('total');
        }
    }

    public function render()
    {
        return view('livewire.components.dashboard-charts', [
            'positionNames' => $this->positionNames,
            'employeeCounts' => $this->employeeCounts,
            'payrollAmounts' => $this->payrollAmounts,
            'travelExpenses' => $this->travelExpenses
        ]);
    }
}
