<?php

namespace App\Livewire\Credit;

use App\Models\Credit;
use App\Models\Employee;
use Livewire\Component;

class CreateCredit extends Component
{
    public $amount, $installments, $employee_id;

    protected $rules = [
        'amount' => 'required|numeric|min:0',
        'installments' => 'required|integer|min:1',
        'employee_id' => 'required|exists:employees,id',
    ];

    public function store()
    {
        $this->validate();

        Credit::create([
            'amount' => $this->amount,
            'installments' => $this->installments,
            'remaining_amount' => $this->amount, // Inicialmente el monto restante es igual al total
            'employee_id' => $this->employee_id,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Crédito registrado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('credit.index');
    }

    public function render()
    {
        $employees = Employee::with('person')
            ->get()
            ->pluck('person.name', 'id');

        return view('livewire.credit.create-credit', compact('employees'));
    }
}
