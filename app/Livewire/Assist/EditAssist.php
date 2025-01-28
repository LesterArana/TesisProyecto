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
    public $date;
    public $status;

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'projet_id' => 'required|exists:projets,id',
        'date' => 'required|date',
        'status' => 'required|boolean',
    ];

    public function mount(Assist $assist)
    {
        $this->assist = $assist;
        $this->employee_id = $assist->employee_id;
        $this->projet_id = $assist->projet_id;
        $this->date = $assist->start_date;
        $this->status = $assist->status;
    }

    public function update()
    {
        $this->validate();

        $this->assist->update([
            'employee_id' => $this->employee_id,
            'projet_id' => $this->projet_id,
            'start_date' => $this->date,
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
