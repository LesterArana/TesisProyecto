<?php

namespace App\Livewire\Employee;

use App\Models\Person;
use App\Models\Position;
use App\Models\Employee;
use Livewire\Component;

class CreateEmployee extends Component
{
    public $name, $address, $dpi, $phone_number, $email, $status = 1;
    public $position_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'dpi' => 'required|string|max:20|unique:people,dpi',
        'phone_number' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'status' => 'boolean',
        'position_id' => 'required|exists:positions,id',
    ];

    public function store()
    {
        $this->validate();

        // Crear el registro en la tabla `people`
        $person = Person::create([
            'name' => $this->name,
            'address' => $this->address,
            'dpi' => $this->dpi,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'status' => $this->status,
        ]);

        // Crear el registro en la tabla `employees`
        Employee::create([
            'person_id' => $person->id,
            'position_id' => $this->position_id,
        ]);

        // Mensaje de éxito
        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Empleado creado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        // Redirigir a la lista de empleados
        return redirect()->route('employees.index');
    }

    public function render()
    {
        // Obtener las posiciones activas para el select
        $positions = Position::where('status', 1)->pluck('name', 'id');

        return view('livewire.employee.create-employee', compact('positions'));
    }
}

