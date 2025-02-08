<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
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
        $assist = Assist::findOrFail($assistId);
        $assist->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Asistencia eliminada exitosamente!',
        ]);
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir === 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'ASC';
    }

    public function redirecttBulk(){
        return redirect()->route('assists.create.bulk')->with('status', 'redirect');
    }
    public function redirectt(){
        return redirect()->route('assists.create.manual')->with('status', 'redirect');
    }
    public function redirecttqr(){
        return redirect()->route('assists.create.qr')->with('status', 'redirect');
    }

    public function render()
    {
        $assists = Assist::whereHas('employee.person', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->orWhereHas('projet', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.assist.table-assist', compact('assists'));
    }
}
