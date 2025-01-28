<?php

namespace App\Livewire\Schedules;

use App\Models\Schedule;
use Livewire\Component;

class CreateSchedules extends Component
{
    public $start;
    public $end;

    protected $rules = [
        'start' => 'required|date_format:H:i',
        'end' => 'required|date_format:H:i|after:start',
    ];

    public function store()
    {
        $this->validate();

        try {
            Schedule::create([
                'start' => $this->start,
                'end' => $this->end,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Horario registrado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('schedules.index');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ocurrió un error al registrar el horario. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.schedules.create-schedules');
    }
}
