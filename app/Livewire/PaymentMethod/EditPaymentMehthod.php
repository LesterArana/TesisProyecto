<?php

namespace App\Livewire\PaymentMethod;

use App\Models\PaymentMethod;
use Livewire\Component;

class EditPaymentMehthod extends Component
{  public $payment_method_id;
    public $name;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function mount(PaymentMethod $payment_method)
    {
        $this->payment_method_id = $payment_method->id;
        $this->name = $payment_method->name;


    }

    public function update()
    {
        $data = $this->validate();

        $payment_method = PaymentMethod::find($this->payment_method_id);


        $payment_method->name = $this->name;


        if ($payment_method->isDirty()) {
            $payment_method->save();

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Método de pago actualizado con éxito.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
        return redirect()->route('payment_methods.index');
    }

    public function render()
    {
        return view('livewire.payment-method.edit-payment-method');
    }
}
