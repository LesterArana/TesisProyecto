<?php

namespace App\Livewire\FixedPayments;

use App\Models\FixedPayment;
use Livewire\Component;

class ShowFixedPayments extends Component
{
    public $fixedPayment;

    public function mount(FixedPayment $fixedPayment)
    {
        $this->fixedPayment = $fixedPayment;
    }

    public function render()
    {
        return view('livewire.fixed-payments.show-fixed-payments');
    }
}
