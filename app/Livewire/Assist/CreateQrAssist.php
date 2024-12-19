<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
use App\Models\Employee;
use App\Models\Projet;
use Livewire\Component;

class CreateQrAssist extends Component
{
    public $employee_id;
    public $projet_id;
    public $activity;

    protected $listeners = ['scanQrCode' => 'handleQrCode'];

    protected $rules = [
        'projet_id' => 'required|exists:projets,id',
        'activity' => 'required|in:entrada,salida',
    ];

    public function handleQrCode($decodedText)
    {
        $employee = Employee::find($decodedText);

        if ($employee) {
            $this->employee_id = $employee->id;

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => "QR escaneado correctamente para {$employee->person->name}.",
            ]);
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'QR inválido o empleado no encontrado.',
            ]);
        }
    }

    public function store()
    {
        $this->validate();

        Assist::create([
            'employee_id' => $this->employee_id,
            'projet_id' => $this->projet_id,
            'activity' => $this->activity === 'entrada' ? 1 : 0,
            'start_date' => $this->activity === 'entrada' ? now() : null,
            'end_date' => $this->activity === 'salida' ? now() : null,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => '¡Asistencia registrada exitosamente!',
        ]);

        $this->reset(['employee_id', 'projet_id', 'activity']);
    }

    public function render()
    {
        return view('livewire.assist.create-qr-assist', [
            'projets' => Projet::all(),
        ]);
    }
}
