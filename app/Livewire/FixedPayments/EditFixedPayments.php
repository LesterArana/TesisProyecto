<?php

namespace App\Livewire\FixedPayments;

use App\Models\FixedPayment;
use Livewire\Component;

class EditFixedPayments extends Component
{
    public $fixed_payment_id;
    public $subject_to_iggs_payment;
    public $bonus_incentive;

    protected $rules = [
        'subject_to_iggs_payment' => 'required|numeric|min:0',
        'bonus_incentive' => 'required|numeric|min:0',
    ];

    public function mount(FixedPayment $fixedPayment)
    {
        $this->fixed_payment_id = $fixedPayment->id;
        $this->subject_to_iggs_payment = $fixedPayment->subject_to_iggs_payment;
        $this->bonus_incentive = $fixedPayment->bonus_incentive;
    }

    public function update()
    {
        $this->validate();

        try {
            $fixedPayment = FixedPayment::findOrFail($this->fixed_payment_id);

            $fixedPayment->update([
                'subject_to_iggs_payment' => $this->subject_to_iggs_payment,
                'bonus_incentive' => $this->bonus_incentive,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Pago fijo actualizado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            // Redirigir a la lista de registros
            return redirect()->route('fixed-payments.index');
        } catch (\Exception $e) {
            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Ocurrió un error al actualizar el pago fijo. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.fixed-payments.edit-fixed-payments');
    }
}
