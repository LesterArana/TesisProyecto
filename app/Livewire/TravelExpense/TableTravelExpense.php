<?php

namespace App\Livewire\TravelExpense;

use App\Models\TravelExpense;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableTravelExpense extends Component
{
    use WithPagination;

    protected $listeners = ['deleteTravelExpense'];

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

    public function deleteTravelExpense($expenseId)
    {
        DB::beginTransaction();
        try {
            $expense = TravelExpense::find($expenseId);
            if ($expense) {
                $expense->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Gasto de viaje eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('travel-expenses.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el gasto de viaje: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('travel-expenses.index');
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
        return redirect()->route('travel-expenses.create')->with('status', 'redirect');
    }

    public function render()
    {
        $travelExpenses = TravelExpense::with('employee.person')
            ->where(function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('voucher_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('employee.person', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%'); // Filtrar por nombre de persona
                    });
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.travel-expense.table-travel-expense', compact('travelExpenses'));
    }

}
