<?php

namespace App\Livewire\BankAccount;

use App\Models\BankAccount;
use Livewire\Component;

class EditBankAccount extends Component
{
    public $bank_account_id;
    public $name_bank;
    public $account_number;

    protected $rules = [
        'name_bank' => 'required|max:255',
        'account_number' => 'required|max:255',
    ];

    public function mount(BankAccount $bank_account)
    {
        $this->bank_account_id = $bank_account->id;
        $this->name_bank = $bank_account->name_bank;
        $this->account_number = $bank_account->account_number;
    }

    public function editBankAccount()
    {
        $this->validate();

        $bank_account = BankAccount::find($this->bank_account_id);


        $bank_account->name_bank = $this->name_bank;
        $bank_account->account_number = $this->account_number;


        if ($bank_account->isDirty()) {
            $bank_account->save();

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Cuenta actualizada exitosamente',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
        return redirect()->route('bank_account.index');
    }

    public function render()
    {
        return view('livewire.bank-account.edit-bank-account');
    }
}
