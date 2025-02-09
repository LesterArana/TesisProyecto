<?php

namespace App\Livewire\Schedules;

use App\Models\Schedule;
use Livewire\Component;

class ShowSchedules extends Component
{
    public $schedule;

    public function mount(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function render()
    {
        return view('livewire.schedules.show-schedules');
    }
}
