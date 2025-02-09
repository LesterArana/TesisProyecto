<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QrAsist extends Component
{
    public $codigo_empleado;
    public $projet_id = 1;

    protected $rules = [
        'codigo_empleado' => 'required|exists:employees,id',
    ];

    public function registrarAsistencia()
    {
        $this->validate();

        $employee = Employee::find($this->codigo_empleado);

        if (!$employee) {
            session()->flash('error', 'Empleado no encontrado.');
            $this->dispatch('reloadPageWithDelay');
            return;
        }

        $existingAssist = Assist::where('employee_id', $employee->id)
            ->whereDate('start_date', now())
            ->exists();

        if ($existingAssist) {
            session()->flash('error', 'Ya existe una asistencia registrada para este empleado hoy.');
            $this->dispatch('reloadPageWithDelay');
            return;
        }

        Assist::create([
            'employee_id' => $employee->id,
            'projet_id' => $this->projet_id,
            'start_date' => now(),
            'status' => 1,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Asistencia registrada correctamente.');
        $this->dispatch('reloadPageWithDelay');
    }

    public function render()
    {
        return view('livewire.assist.qr-asist');
    }
}
