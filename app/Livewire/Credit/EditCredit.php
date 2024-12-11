<?php
namespace App\Livewire\Credit;

use App\Models\BankAccount;
use App\Models\Credit;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditCredit extends Component
{
    use WithFileUploads;

    public $creditId;
    public $supplier_id, $bank_account_id, $payment_method_id, $voucher_number, $date, $mount, $status = 1, $image;
    public $suppliers, $bank_accounts, $payment_methods;
    public $imagePreview;
    public $currentImage;

    protected function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'voucher_number' => 'required|max:255|unique:credits,voucher_number,' . $this->creditId,
            'date' => 'required|date',
            'mount' => 'required|numeric|min:1',
            'status' => 'required|boolean',
            'image' => 'nullable|image|max:1024', // 1MB Max
        ];
    }

    public function mount($credit)
    {
        $this->suppliers = Supplier::all();
        $this->bank_accounts = BankAccount::all();
        $this->payment_methods = PaymentMethod::all();

        $credit = Credit::find($credit);

        if ($credit) {
            $this->creditId = $credit->id;
            $this->supplier_id = $credit->supplier_id;
            $this->bank_account_id = $credit->bank_account_id;
            $this->payment_method_id = $credit->payment_method_id;
            $this->voucher_number = $credit->voucher_number;
            $this->date = $credit->date;
            $this->mount = $credit->mount;
            $this->status = $credit->status;
            $this->currentImage = $credit->imageable ? $credit->imageable->path : null;
        }
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
    public function update()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $credit = Credit::find($this->creditId);

            $credit->supplier_id = $this->supplier_id;
            $credit->bank_account_id = $this->bank_account_id;
            $credit->payment_method_id = $this->payment_method_id;
            $credit->voucher_number = $this->voucher_number;
            $credit->date = $this->date;
            $credit->mount = $this->mount;
            $credit->status = $this->status;


            if ($credit->isDirty() || $this->image) {
                $credit->save();


                if ($this->image) {
                    $path = $this->image->store('image_credit', 'public');

                    if ($credit->imageable) {

                        Storage::disk('public')->delete($credit->imageable->path);
                        $credit->imageable->update(['path' => $path]);
                    } else {
                        $credit->imageable()->create(['path' => $path]);
                    }
                }

                DB::commit();

                session()->flash('alert', [
                    'type' => 'success',
                    'message' => '¡Crédito actualizado exitosamente!',
                    'position' => 'center',
                    'timer' => 6000,
                ]);

            } else {
                DB::commit();
                return redirect()->route('credit.index');
            }

            return redirect()->route('credit.index');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'error',
                'message' => 'Error al actualizar el crédito: ' . $e->getMessage(),
                'position' => 'center',
                'timer' => 6000,
            ]);
            return redirect()->route('credit.edit', $this->creditId);
        }
    }

    public function render(){
        return view('livewire.credit.edit-credit');
    }
}
