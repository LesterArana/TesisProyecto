<?php

namespace App\Livewire\Credit;

use App\Models\Credit;
use Livewire\Component;

class ShowCredit extends Component
{
    public $creditId;

    public function mount(Credit $credit)
    {
        $this->creditId = $credit->id; // Asigna el ID del crédito
    }

    public function render()
    {
        $credit = Credit::with(['employee', 'payments'])->findOrFail($this->creditId); // Usa $creditId para buscar

        return view('livewire.credit.show-credit', compact('credit'));
    }
}
