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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'dpi' => 'required|string|max:20|unique:people,dpi,' . $this->employee_id,
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'boolean',
            'position_id' => 'required|exists:positions,id',
        ];
    }

    public function mount(Employee $employee)
    {
        $this->employee_id = $employee->person->id;

        $this->name = $employee->person->name;
        $this->address = $employee->person->address;
        $this->dpi = $employee->person->dpi;
        $this->phone_number = $employee->person->phone_number;
        $this->email = $employee->person->email;
        $this->status = (bool) $employee->person->status;

        $this->position_id = $employee->position_id;
    }

    public function update()
    {
        $this->validate();

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

        $employee->update([
            'position_id' => $this->position_id,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Empleado actualizado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('employees.index');
    }

    public function render()
    {
        $positions = Position::where('status', 1)->pluck('name', 'id');

        return view('livewire.employee.edit-employee', compact('positions'));
    }
}

