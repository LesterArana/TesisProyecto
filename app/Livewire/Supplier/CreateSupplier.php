<?php
namespace App\Livewire\Supplier;

use App\Models\Person;
use App\Models\Supplier;
use Livewire\Component;

class CreateSupplier extends Component
{
    public $type_person,$company_name, $address, $email, $phone_number, $nit_number, $state = 1;

    protected $rules = [
        'type_person' => 'required|in:Persona natural,Persona jurídica',
        'company_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone_number' => 'required|string|max:20',
        'nit_number' => 'required|string|max:14',
    ];

    public function store()
    {
        $this->validate();

        $person = Person::create([
            'type_person' => $this->type_person,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'nit_number' => $this->nit_number,
            'state' => $this->state,
        ]);

        Supplier::create([
            'person_id' => $person->id,
            'pending_debt' => 0,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Proveedor creado exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('supplier.index');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['type_person','company_name', 'address', 'email', 'phone_number', 'state', 'nit_number']);
    }

    public function render()
    {
        return view('livewire.supplier.create-supplier');
    }
}
