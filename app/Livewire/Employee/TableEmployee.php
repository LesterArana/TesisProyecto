<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableEmployee extends Component
{
    use WithPagination;

    protected $listeners = ['deleteEmployee'];

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

    public function deleteEmployee($employeeId)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::find($employeeId);
            if ($employee) {
                $employee->delete();
            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Empleado eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el empleado: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('employees.index');
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

    public function redirectt()
    {
        return redirect()->route('employees.create')->with('status', 'redirect');
    }

    public function render()
    {
        $employees = Employee::whereHas('person', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->orWhereHas('position', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.employee.table-employee', compact('employees'));
    }
}
