<?php

namespace App\Livewire\Projet;

use App\Models\Projet;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableProjet extends Component
{
    use WithPagination;

    protected $listeners = ['deleteProjet'];

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

    public function deleteProjet($projetId)
    {
        DB::beginTransaction();
        try {
            $projet = Projet::find($projetId);
            if ($projet) {
                $projet->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Proyecto eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('projets.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el proyecto: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('projets.index');
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
        return redirect()->route('projets.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.projet.table-projet', [
            'projets' => Projet::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
