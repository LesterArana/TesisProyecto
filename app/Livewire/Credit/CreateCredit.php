<?php

namespace App\Livewire\Credit;

use App\Models\BankAccount;
use App\Models\Credit;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCredit extends Component
{
    use WithFileUploads;

    public $suppliers;
    public $bank_accounts;
    public $payment_methods;

    public $supplier_id;
    public $bank_account_id;
    public $payment_method_id;
    public $voucher_number;
    public $date;
    public $mount;
    public $status = 1;
    public $image;
    public $imagePreview;

    protected $rules = [
        'supplier_id' => 'required|exists:suppliers,id',
        'bank_account_id' => 'required|exists:bank_accounts,id',
        'payment_method_id' => 'required|exists:payment_methods,id',
        'voucher_number' => 'required|max:255|unique:credits,voucher_number',
        'date' => 'required|date',
        'mount' => 'required|numeric|min:1',
        'status' => 'required|boolean',
        'image' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount()
    {
        $this->suppliers = Supplier::whereHas('person', function ($query) {
            $query->where('state', 1);
        })->get();

        $this->bank_accounts = BankAccount::all();
        $this->payment_methods = PaymentMethod::all();
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);

        if ($this->image) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function store()
    {
        $this->validate();

        DB::beginTransaction();

        try {

            $credit = Credit::create([
                'supplier_id' => $this->supplier_id,
                'bank_account_id' => $this->bank_account_id,
                'payment_method_id' => $this->payment_method_id,
                'voucher_number' => $this->voucher_number,
                'date' => $this->date,
                'mount' => $this->mount,
                'status' => $this->status,
            ]);

            // Manejo de la imagen si existe
            if ($this->image) {
                $path = $this->image->store('image_credit', 'public');

                $credit->imageable()->create([
                    'path' => $path,
                ]);

            }

            DB::commit();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Crédito creado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);

            return redirect()->route('credit.index');
            $this->resetInputFields();

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('mostrarAlertaError', 'Error al crear el crédito: ' . $e->getMessage());
        }
    }

    private function resetInputFields()
    {
        $this->reset(['supplier_id', 'bank_account_id', 'payment_method_id', 'voucher_number', 'date', 'mount', 'status', 'image', 'imagePreview']);
    }

    public function render()
    {
        return view('livewire.credit.create-credit');
    }
}
