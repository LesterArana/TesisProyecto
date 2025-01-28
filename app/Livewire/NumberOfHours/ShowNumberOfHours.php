<?php

namespace App\Livewire\NumberOfHours;

use App\Models\Employee;
use App\Models\NumberOfHour;
use Livewire\Component;

class ShowNumberOfHours extends Component
{
    public $numberOfHours;

    public function mount(NumberOfHour $numberOfHours)
    {
        $this->numberOfHours = $numberOfHours;
    }

    public function render()
    {
        return view('livewire.number-of-hours.show-number-of-hours');
    }
}
