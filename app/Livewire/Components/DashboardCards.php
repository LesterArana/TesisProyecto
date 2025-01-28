<?php

namespace App\Livewire\Components;

use App\Models\Credit;
use App\Models\CustomerPayment;
use App\Models\Employee;
use App\Models\PaymentCustomerAccount;
use App\Models\Position;
use App\Models\Projet;
use App\Models\Sale;
use App\Models\Shopping;
use Livewire\Component;

class DashboardCards extends Component
{
    public $activeEmployees;
    public $activeProjects;
    public $activePosition;

    public function mount()
    {

        $this->activeEmployees = Employee::whereHas('person', function ($query) {
            $query->where('status', 1);
        })->count();

        $this->activeProjects = Projet::where('status', 1)->count();

        $this->activePosition = Position::where('status', 1)->count();

    }

    public function render()
    {
        return view('livewire.components.dashboard-cards');
    }
}
