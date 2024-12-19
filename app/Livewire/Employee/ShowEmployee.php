<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class ShowEmployee extends Component
{
    public $employee;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        return view('livewire.employee.show-employee');
    }
}
