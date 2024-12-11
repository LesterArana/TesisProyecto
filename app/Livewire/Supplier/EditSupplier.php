<?php

namespace App\Livewire\Supplier;

use App\Models\Person;
use App\Models\Supplier;
use Livewire\Component;

class EditSupplier extends Component
{
    public $supplierId;
    public $company_name, $address, $email, $phone_number, $type_person, $state = 1, $nit_number;

    protected function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'required|string|max:20',
            'type_person' => 'required|in:Persona natural,Persona jurídica',
            'nit_number' => 'required|string|max:14',
        ];
    }

    public function mount($supplier)
    {
        $this->supplierId = $supplier;
        $supplier = Supplier::with('person')->find($supplier);

        if ($supplier) {
            $this->company_name = $supplier->person->company_name;
            $this->address = $supplier->person->address;
            $this->email = $supplier->person->email;
            $this->phone_number = $supplier->person->phone_number;
            $this->type_person = $supplier->person->type_person;
            $this->nit_number = $supplier->person->nit_number;
            $this->state = $supplier->person->state;
        }
    }

    public function update()
    {
        $this->validate();

        $supplier = Supplier::with('person')->find($this->supplierId);


        $supplier->person->company_name = $this->company_name;
        $supplier->person->address = $this->address;
        $supplier->person->email = $this->email;
        $supplier->person->phone_number = $this->phone_number;
        $supplier->person->type_person = $this->type_person;
        $supplier->person->nit_number = $this->nit_number;
        $supplier->person->state = $this->state;


        if ($supplier->person->isDirty()) {
            $supplier->person->save();;

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Proveedor editado exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
        return redirect()->route('supplier.index');
    }

    public function render()
    {
        return view('livewire.supplier.edit-supplier');
    }
}
