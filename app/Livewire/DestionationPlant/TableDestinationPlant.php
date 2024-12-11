<?php

namespace App\Livewire\DestionationPlant;

use App\Models\CustomerPayment;
use App\Models\DestinationPlant;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableDestinationPlant extends Component
{
    use WithPagination;


    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;

    protected $listeners = ['deleteDestinationPlant'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteDestinationPlant($destinationPlantId)
    {
        DB::beginTransaction();
        try {
            $destinationPlant = DestinationPlant::find($destinationPlantId);
            $destinationPlant->delete();

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Planta eliminada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('destination_plant.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando la planta : ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('destination_plant.index');
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
        return redirect()->route('destination_plant.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.destionation-plant.table-destination-plant', [
            'destinationPlants' => DestinationPlant::where(function ($query) {
                $searchLower = strtolower($this->search);

                if ($searchLower == 'activo') {
                    $query->where('status', 1);
                } elseif ($searchLower == 'inactivo') {
                    $query->where('status', 0);
                } else {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('address', 'like', '%' . $this->search . '%')
                        ->orWhereRaw('DATE(created_at) like ?', ['%' . $this->search . '%']) // Búsqueda solo por fecha
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer.person', function ($query) {
                            $query->where('company_name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('country', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                }
            })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
