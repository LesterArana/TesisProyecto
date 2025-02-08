<?php

namespace App\Livewire\FixedPayments;

use App\Models\FixedPayment;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableFixedPayments extends Component
{
    use WithPagination;

    protected $listeners = ['deleteFixedPayment'];

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteFixedPayment($id)
    {
        DB::beginTransaction();
        try {
            $fixedPayment = FixedPayment::findOrFail($id);
            $fixedPayment->delete();

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Pago fijo eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error al eliminar el pago fijo. Intente nuevamente.',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
    }

    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'ASC';
        }
    }

    public function render()
    {
        $fixedPayments = FixedPayment::where('subject_to_iggs_payment', 'like', '%' . $this->search . '%')
            ->orWhere('bonus_incentive', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.fixed-payments.table-fixed-payments', compact('fixedPayments'));
    }
}
