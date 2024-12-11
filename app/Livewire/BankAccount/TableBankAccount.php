<?php

namespace App\Livewire\BankAccount;

use App\Models\BankAccount;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TableBankAccount extends Component
    {
    use WithPagination;

    protected $listeners = ['deleteBankAccount'];

    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;
    public function updatedSearch(){
        $this->resetPage();
    }

    public function deleteBankAccount($bankAccountId)
    {
        DB::beginTransaction();
        try {
            $bank_account = BankAccount::find($bankAccountId);
            if ($bank_account) {
                $bank_account->delete();
            }
            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Cuenta de banco eliminada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('bank_account.index');
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error eliminando la cuenta: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('bank_account.index');
        }
    }

    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function redirectt(){
        return redirect()->route('bank_account.create')->with('status', 'redirect');
    }

    public function render()
    {
        return view('livewire.bank-account.table-bank-account', [
            'bank_accounts' => BankAccount::where('name_bank', 'like', '%' . $this->search . '%')
                ->orWhere('account_number', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
    }
