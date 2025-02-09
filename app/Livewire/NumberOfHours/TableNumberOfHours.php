<?php

namespace App\Livewire\NumberOfHours;

use App\Models\NumberOfHour;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableNumberOfHours extends Component
{
    use WithPagination;

    protected $listeners = ['deleteNumberOfHours'];

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

    public function deleteNumberOfHours($recordId)
    {
        DB::beginTransaction();
        try {
            $numberOfHours = NumberOfHour::find($recordId);
            if ($numberOfHours) {
                $numberOfHours->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Registro eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('number-of-hours.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el registro: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('number-of-hours.index');
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
        return redirect()->route('number-of-hours.create')->with('status', 'redirect');
    }

    public function render()
    {
        $numberOfHours = NumberOfHour::whereHas('employee.person', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.number-of-hours.table-number-of-hours', compact('numberOfHours'));
    }
}
