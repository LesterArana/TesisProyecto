<?php
namespace App\Livewire\Position;

use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TablePosition extends Component
{
    use WithPagination;

    protected $listeners = ['deletePosition'];

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

    public function deletePosition($positionId)
    {
        DB::beginTransaction();
        try {
            $position = Position::find($positionId);
            if ($position) {
                $position->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Puesto eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('positions.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el puesto: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('positions.index');
        }
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir === 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function redirectt()
    {
        return redirect()->route('positions.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.position.table-position', [
            'positions' => Position::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
