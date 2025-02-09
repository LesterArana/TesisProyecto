<?php

namespace App\Livewire\Schedules;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableSchedules extends Component
{
    use WithPagination;

    protected $listeners = ['deleteSchedule'];

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

    public function deleteSchedule($id)
    {
        DB::beginTransaction();
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->delete();

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Horario eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error al eliminar el horario. Intente nuevamente.',
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
        $schedules = Schedule::where('start', 'like', '%' . $this->search . '%')
            ->orWhere('end', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.schedules.table-schedules', compact('schedules'));
    }
}
