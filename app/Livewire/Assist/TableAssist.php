<?php
namespace App\Livewire\Assist;
namespace App\Livewire\Assist;

use App\Models\Assist;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableAssist extends Component
{
    use WithPagination;

    protected $listeners = ['deleteAssist'];

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteAssist($assistId)
    {
        DB::beginTransaction();
        try {
            $assist = Assist::find($assistId);
            if ($assist) {
                $assist->delete();
            }
            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Asistencia eliminada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('assists.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando la asistencia: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('assists.index');
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
        return redirect()->route('assists.create.manual')->with('status', 'redirect');
    }
    public function redirecttQR()
    {
        return redirect()->route('assists.create.qr')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.assist.table-assist', [
            'assists' => Assist::whereHas('employee.person', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('projet', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }
}
