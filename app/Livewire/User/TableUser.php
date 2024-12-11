<?php

namespace App\Livewire\User;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableUser extends Component
{

    use WithPagination;

    protected $listeners = ['deleteUser'];

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

    public function deleteUser($userId)
    {
        DB::beginTransaction();
        try {
            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }
            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Usuario eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el usuario: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('user.index');
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

    public function redirectt(){
        return redirect()->route('user.create')->with('status', 'redirect');
    }

    public function render()
    {
        $users = User::with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere(function ($query) {
                if (strtolower($this->search) === 'activo') {
                    $query->where('status', 1);
                } elseif (strtolower($this->search) === 'desactivado') {
                    $query->where('status', 0);
                }
            })
            ->orWhereHas('roles', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.user.table-user', [
            'users' => $users,
        ]);
    }
}
