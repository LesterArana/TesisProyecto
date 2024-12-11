<?php

namespace App\Livewire\BankAccount;

use App\Models\BankAccount;
use Livewire\Component;

class ShowBankAccounts extends Component
{

    public $bank_account;

    public function mount(BankAccount $bank_account)
    {
        $this->bank_account = $bank_account;
    }
    public function render()
    {
        return view('livewire.bank-account.show-bank-accounts');
    }
}
