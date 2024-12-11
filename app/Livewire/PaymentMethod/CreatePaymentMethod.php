<?php

namespace App\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

class CreatePaymentMethod extends Component
{    public $name;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function store()
    {
        $datos = $this->validate();


        PaymentMethod::create([
            'name' => $datos['name'],
        ]);


        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Método de pago creado con éxito',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('payment_methods.index');
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.payment-method.create-payment-method');
    }
}
