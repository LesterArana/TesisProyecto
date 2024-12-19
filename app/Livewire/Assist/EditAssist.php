<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
use App\Models\Employee;
use App\Models\Projet;
use Livewire\Component;

class EditAssist extends Component
{
    public $assist;
    public $employee_id;
    public $projet_id;
    public $activity;
    public $start_date;
    public $end_date;
    public $status;

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'projet_id' => 'required|exists:projets,id',
        'activity' => 'required|in:entrada,salida',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'status' => 'required|boolean',
    ];

    public function mount(Assist $assist)
    {
        $this->assist = $assist;
        $this->employee_id = $assist->employee_id;
        $this->projet_id = $assist->projet_id;
        $this->activity = $assist->activity ? 'entrada' : 'salida';
        $this->start_date = $assist->start_date;
        $this->end_date = $assist->end_date;
        $this->status = $assist->status;
    }

    public function update()
    {
        $this->validate();

        $this->assist->update([
            'employee_id' => $this->employee_id,
            'projet_id' => $this->projet_id,
            'activity' => $this->activity === 'entrada' ? 1 : 0,
            'start_date' => $this->start_date,
            'end_date' => $this->activity === 'salida' ? $this->end_date : null,
            'status' => $this->status,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Asistencia actualizada exitosamente!',
        ]);

        return redirect()->route('assists.index');
    }

    public function render()
    {
        return view('livewire.assist.edit-assist', [
            'employees' => Employee::all(),
            'projets' => Projet::all(),
        ]);
    }
}
