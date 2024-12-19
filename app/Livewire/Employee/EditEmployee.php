<?php

namespace App\Livewire\Employee;

use App\Models\Person;
use App\Models\Position;
use App\Models\Employee;
use Livewire\Component;

class EditEmployee extends Component
{
    public $employee_id;
    public $name, $address, $dpi, $phone_number, $email, $status;
    public $position_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'dpi' => 'required|string|max:20|unique:people,dpi,{{person_id}}', // Validación DPI único excepto el actual
        'phone_number' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'status' => 'boolean',
        'position_id' => 'required|exists:positions,id',
    ];

    public function mount(Employee $employee)
    {
        $this->employee_id = $employee->id;

        // Cargar datos de la persona asociada al empleado
        $this->name = $employee->person->name;
        $this->address = $employee->person->address;
        $this->dpi = $employee->person->dpi;
        $this->phone_number = $employee->person->phone_number;
        $this->email = $employee->person->email;
        $this->status = $employee->person->status;

        // Cargar el puesto del empleado
        $this->position_id = $employee->position_id;
    }

    public function update()
    {
        $this->validate();

        // Actualizar la información en la tabla `people`
        $employee = Employee::findOrFail($this->employee_id);
        $person = $employee->person;

        $person->update([
            'name' => $this->name,
            'address' => $this->address,
            'dpi' => $this->dpi,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'status' => $this->status,
        ]);

        // Actualizar el puesto del empleado
        $employee->update([
            'position_id' => $this->position_id,
        ]);

        // Mensaje de éxito
        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Empleado actualizado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        // Redirigir al índice de empleados
        return redirect()->route('employees.index');
    }

    public function render()
    {
        // Obtener las posiciones activas para el select
        $positions = Position::where('status', 1)->pluck('name', 'id');

        return view('livewire.employee.edit-employee', compact('positions'));
    }
}
