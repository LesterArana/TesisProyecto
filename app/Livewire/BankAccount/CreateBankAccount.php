<?php

namespace App\Livewire\BankAccount;

use App\Models\BankAccount;
use Livewire\Component;

class CreateBankAccount extends Component
{
    public $name_bank;
    public $account_number;

    protected $rules = [
        'name_bank' => 'required|max:255',
        'account_number' => 'required|max:255',
    ];

    public function store()
    {
        $datos = $this->validate();


        BankAccount::create([
            'name_bank' => $datos['name_bank'],
            'account_number' => $datos['account_number'],
        ]);


        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Cuenta bancaria creada con éxito',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('bank_account.index');
        $this->reset(['name_bank', 'account_number']);
    }

    public function render()
    {
        return view('livewire.bank-account.create-bank-account');
    }
}
