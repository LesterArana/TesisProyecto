<?php

namespace App\Livewire\PaymentMethod;

use App\Models\DestinationPlant;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TablePaymentMethod extends Component
{
    use WithPagination;

    protected $listeners = ['deletePaymentMethod'];

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;

    public function updatedSearch()
    {
        $this->resetPage();
    }



    public function deletePaymentMethod($paymentMethodId)
    {
        DB::beginTransaction();
        try {
            $payment_method = PaymentMethod::find($paymentMethodId);
            if ($payment_method) {
                $payment_method->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Metodo de pago eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('payment_methods.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el metodo de pago : ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('payment_methods.index');
        }
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function redirectt()
    {
        return redirect()->route('payment_methods.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.payment-method.table-payment-method', [
            'payment_methods' => PaymentMethod::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
