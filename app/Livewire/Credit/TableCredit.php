<?php

namespace App\Livewire\Credit;

use App\Models\Credit;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableCredit extends Component
{
    use WithPagination;

    protected $listeners = ['deleteCredit'];

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

    public function deleteCredit($creditId)
    {
        DB::beginTransaction();
        try {
            $credit = Credit::find($creditId);

            if (!$credit) {
                $this->dispatch('mostrarAlertaError', 'El crédito no existe.');
                return;
            }

            if ($credit->payments()->exists()) {
                $this->dispatch('mostrarAlertaError', 'El crédito no puede ser eliminado porque tiene pagos asociados.');
                return;
            }

            $credit->delete();

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Crédito eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('credit.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el crédito: ' . $e->getMessage(),
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

    public function redirectToCreate()
    {
        return redirect()->route('credit.create')->with('status', 'redirect');
    }

    public function render()
    {
        $credits = Credit::with('employee.person') // Cargar la relación person del modelo Employee
        ->whereHas('employee.person', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%'); // Accede a name en Person
        })
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->orWhere('remaining_amount', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.credit.table-credit', compact('credits'));
    }

}
