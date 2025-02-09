<?php

namespace App\Livewire\TravelExpense;

use App\Models\TravelExpense;
use App\Models\Employee;
use Livewire\Component;

class EditTravelExpense extends Component
{
    public $expense_id, $amount, $voucher_number, $description, $status, $employee_id;

    protected function rules()
    {
        return [
            'amount' => 'required|numeric|min:0',
            'voucher_number' => 'required|string|max:255|unique:travel_expenses,voucher_number,' . $this->expense_id,
            'description' => 'required|string|max:255',
            'status' => 'boolean',
            'employee_id' => 'required|exists:employees,id',
        ];
    }


    public function mount(TravelExpense $travelExpense)
    {
        $this->expense_id = $travelExpense->id;
        $this->amount = $travelExpense->amount;
        $this->voucher_number = $travelExpense->voucher_number;
        $this->description = $travelExpense->description;
        $this->status = $travelExpense->status;
        $this->employee_id = $travelExpense->employee_id;
    }

    public function update()
    {
        $this->validate();

        $travelExpense = TravelExpense::findOrFail($this->expense_id);

        $travelExpense->update([
            'amount' => $this->amount,
            'voucher_number' => $this->voucher_number,
            'description' => $this->description,
            'status' => $this->status,
            'employee_id' => $this->employee_id,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Gasto de viaje actualizado exitosamente!',
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

        return view('livewire.travel-expense.edit-travel-expense', compact('employees'));
    }
}
