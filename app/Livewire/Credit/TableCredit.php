<?php

namespace App\Livewire\Credit;

use App\Models\Category;
use App\Models\Credit;
use App\Models\Supplier;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableCredit extends Component
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

    protected $listeners = ['deleteCredit'];

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function deleteCredit($creditId)
    {
        DB::beginTransaction();
        try {
            $credit = Credit::find($creditId);

            if ($credit) {
                $credit->delete();
            }
            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Crédito eliminado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('credit.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando el crédito: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('credit.index');
        }
    }


    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
        } else {
            $this->sortBy = $sortByField;
            $this->sortDir = 'DESC';
        }
    }

    public function redirectt(){
        return redirect()->route('credit.create')->with('status', 'redirect');
    }

    public function render()
    {
        $query = Credit::query()
            ->select('credits.*')
            ->with(['supplier.person', 'bankAccount', 'paymentMethod'])
            ->when($this->sortBy == 'supplier.person.company_name', function($query) {
                $query->join('suppliers', 'credits.supplier_id', '=', 'suppliers.id')
                    ->join('people', 'suppliers.person_id', '=', 'people.id')
                    ->orderBy('people.company_name', $this->sortDir);
            })
            ->when($this->sortBy == 'bankAccount.name_bank', function($query) {
                $query->join('bank_accounts', 'credits.bank_account_id', '=', 'bank_accounts.id')
                    ->orderBy('bank_accounts.name_bank', $this->sortDir);
            })
            ->when($this->sortBy == 'paymentMethod.name', function($query) {
                $query->join('payment_methods', 'credits.payment_method_id', '=', 'payment_methods.id')
                    ->orderBy('payment_methods.name', $this->sortDir);
            })
            ->when(!in_array($this->sortBy, ['supplier.person.company_name', 'bankAccount.name_bank', 'paymentMethod.name']), function($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            });

        $credits = $query->where(function($query) {
            $searchLower = strtolower($this->search);


            if ($searchLower == 'activo') {
                $query->where('status', 1);
            } elseif ($searchLower == 'desactivado') {
                $query->where('status', 0);
            } else {

                $query->where('voucher_number', 'like', '%' . $this->search . '%')
                    ->orWhere('date', 'like', '%' . $this->search . '%')
                    ->orWhere('mount', 'like', '%' . $this->search . '%')
                    ->orWhereHas('supplier.person', function($query) {
                        $query->where('company_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('bankAccount', function($query) {
                        $query->where('account_number', 'like', '%' . $this->search . '%')
                            ->orWhere('name_bank', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('paymentMethod', function($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            }
        })
            ->paginate($this->perPage);

        return view('livewire.credit.table-credit', [
            'credits' => $credits
        ]);
    }

}
