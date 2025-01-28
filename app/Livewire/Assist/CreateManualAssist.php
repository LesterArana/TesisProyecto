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
    public $date;
    public $status = 1; // Asistencia activa por defecto

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'projet_id' => 'required|exists:projets,id',
        'date' => 'required|date',
    ];

    public function store()
    {
        $this->validate();

        $existingAssist = Assist::where('employee_id', $this->employee_id)
            ->whereDate('start_date', $this->date)
            ->exists();

        if ($existingAssist) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ya existe una asistencia registrada para este empleado en la fecha seleccionada.',
            ]);

            return;
        }

        Assist::create([
            'employee_id' => $this->employee_id,
            'projet_id' => $this->projet_id,
            'start_date' => $this->date,
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
