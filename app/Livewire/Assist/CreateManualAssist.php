<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
use App\Models\Employee;
use App\Models\Projet;
use Livewire\Component;

class CreateManualAssist extends Component
{
    public $employee_id;
    public $projet_id;
    public $activity;
    public $start_date;
    public $end_date;
    public $status = 1;

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'projet_id' => 'required|exists:projets,id',
        'activity' => 'required|in:entrada,salida',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
    ];

    public function store()
    {
        dd($this->employee_id);
        $this->validate();

        Assist::create([
            'employee_id' => $this->employee_id,
            'projet_id' => $this->projet_id,
            'activity' => $this->activity === 'entrada' ? 1 : 0,
            'start_date' => $this->start_date,
            'end_date' => $this->activity === 'salida' ? $this->end_date : null,
            'status' => $this->status,
            'user_id' => auth()->id(),
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Asistencia registrada exitosamente!',
        ]);

        return redirect()->route('assists.index');
    }

    public function render()
    {
        return view('livewire.assist.create-manual-assist', [
            'employees' => Employee::all(),
            'projets' => Projet::all(),
        ]);
    }
}
