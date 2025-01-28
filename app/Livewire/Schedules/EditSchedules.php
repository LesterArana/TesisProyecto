<?php

namespace App\Livewire\Schedules;

use App\Models\Schedule;
use Livewire\Component;

class EditSchedules extends Component
{
    public $schedule_id;
    public $start;
    public $end;

    protected $rules = [
        'start' => 'required|date_format:H:i',
        'end' => 'required|date_format:H:i|after:start',
    ];

    public function mount(Schedule $schedule)
    {
        $this->schedule_id = $schedule->id;
        $this->start = $schedule->start;
        $this->end = $schedule->end;
    }

    public function update()
    {
        $this->validate();

        try {
            $schedule = Schedule::findOrFail($this->schedule_id);

            $schedule->update([
                'start' => $this->start,
                'end' => $this->end,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Horario actualizado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('schedules.index');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ocurrió un error al actualizar el horario. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.schedules.edit-schedules');
    }
}
