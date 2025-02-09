<?php

namespace App\Livewire\TravelExpense;

use App\Models\TravelExpense;
use App\Models\Employee;
use Livewire\Component;

class CreateTravelExpense extends Component
{
    public $amount, $voucher_number, $description, $status = false, $employee_id;

    protected $rules = [
        'amount' => 'required|numeric|min:0',
        'voucher_number' => 'required|string|unique:travel_expenses,voucher_number|max:255',
        'description' => 'required|string|max:255',
        'status' => 'boolean',
        'employee_id' => 'required|exists:employees,id',
    ];

    public function store()
    {
        $this->validate();

        TravelExpense::create([
            'amount' => $this->amount,
            'voucher_number' => $this->voucher_number,
            'description' => $this->description,
            'status' => $this->status,
            'employee_id' => $this->employee_id,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Gasto de viaje registrado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('travel-expenses.index');
    }

    public function render()
    {
        $employees = Employee::with('person')
            ->get()
            ->pluck('person.name', 'id');

        return view('livewire.travel-expense.create-travel-expense', compact('employees'));
    }
}
