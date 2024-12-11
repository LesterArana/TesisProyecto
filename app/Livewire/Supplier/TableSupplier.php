<?php

namespace App\Livewire\Supplier;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableSupplier extends Component
{
    use WithPagination;

    protected $listeners = ['deleteSupplier'];

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


    public function deleteSupplier($supplierId)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::find($supplierId);
            if($supplier){
                $supplier->delete();
            }
            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Proveedor eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el proveedor: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('supplier.index');
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
        return redirect()->route('supplier.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.supplier.table-supplier', [
            'suppliers' => Supplier::with(['person', 'credits' => function ($query) {
                $query->selectRaw('supplier_id, SUM(mount) as total_credits')
                    ->where('status', 1)
                    ->groupBy('supplier_id');
            }, 'shoppings' => function ($query) {
                $query->selectRaw('supplier_id, SUM(total_price) as total_shoppings')
                    ->where('status', 1)
                    ->groupBy('supplier_id');
            }])
                ->whereHas('person', function ($query) {
                    $query->where('company_name', 'like', '%' . $this->search . '%')
                        ->orWhere('address', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('nit_number', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                        ->orWhere('type_person', 'like', '%' . $this->search . '%')
                        ->orWhere(function ($query) {
                            // Búsqueda por estado (1 para activo, 0 para inactivo)
                            if (strtolower($this->search) == 'activo') {
                                $query->where('state', 1);
                            } elseif (strtolower($this->search) == 'desactivado') {
                                $query->where('state', 0);
                            }
                        });
                })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
