<?php

namespace App\Livewire\FixedPayments;

use App\Models\FixedPayment;
use Livewire\Component;

class CreateFixedPayments extends Component
{
    public $subject_to_iggs_payment;
    public $bonus_incentive;

    protected $rules = [
        'subject_to_iggs_payment' => 'required|numeric|min:0',
        'bonus_incentive' => 'required|numeric|min:0',
    ];

    public function store()
    {
        $this->validate();

        try {
            FixedPayment::create([
                'subject_to_iggs_payment' => $this->subject_to_iggs_payment,
                'bonus_incentive' => $this->bonus_incentive,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Pago fijo registrado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('fixed-payments.index');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ocurrió un error al registrar el pago fijo. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.fixed-payments.create-fixed-payments');
    }
}
