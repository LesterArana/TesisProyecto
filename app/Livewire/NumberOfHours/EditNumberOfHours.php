<?php

namespace App\Livewire\NumberOfHours;

use App\Models\Employee;
use App\Models\NumberOfHour;
use Livewire\Component;

class EditNumberOfHours extends Component
{
    public $number_of_hours_id;
    public $date;
    public $amount;
    public $type_of_hours;
    public $employee_id;

    protected $rules = [
        'date' => 'required|date',
        'amount' => 'required|numeric|min:0',
        'type_of_hours' => 'required|boolean',
        'employee_id' => 'required|exists:employees,id',
    ];

    public function mount(NumberOfHour $numberOfHours)
    {
        $this->number_of_hours_id = $numberOfHours->id;
        $this->date = $numberOfHours->date;
        $this->amount = $numberOfHours->amount;
        $this->type_of_hours = $numberOfHours->type_of_hours;
        $this->employee_id = $numberOfHours->employee_id;
    }

    public function update()
    {
        $this->validate();

        try {
            $numberOfHours = NumberOfHour::findOrFail($this->number_of_hours_id);

            $numberOfHours->update([
                'date' => $this->date,
                'amount' => $this->amount,
                'type_of_hours' => $this->type_of_hours,
                'employee_id' => $this->employee_id,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Horas actualizadas exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('number-of-hours.index');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ocurrió un error al actualizar las horas. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function render()
    {
        $employees = Employee::with('person')
            ->get()
            ->pluck('person.name', 'id');

        return view('livewire.number-of-hours.edit-number-of-hours', compact('employees'));
    }
}
