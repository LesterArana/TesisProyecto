<?php

namespace App\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

class ShowPaymentMethod extends Component
{
    public $payment_method;

    public function mount(PaymentMethod $payment_method)
    {
        $this->payment_method = $payment_method;
    }

    public function render()
    {
        return view('livewire.payment-method.show-payment-method');
    }
}