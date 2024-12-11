<?php

namespace App\Livewire\DestionationPlant;

use App\Models\Country;
use App\Models\Customer;
use App\Models\DestinationPlant;
use App\Models\Supplier;
use Livewire\Component;

class CreateDestinationPlant extends Component
{
    public $name, $address, $phone_number, $status = 1, $customer_id, $country_id;
    public $customers;
    public $countries;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone_number' => 'required|string|max:13',
        'status' => 'required|boolean',
        'customer_id' => 'required|exists:customers,id',
        'country_id' => 'nullable|exists:countries,id',
    ];

    public function mount()
    {

        $this->customers = Customer::whereHas('person', function($query) {
            $query->where('state', 1);
        })->get();

        $this->countries = Country::all();

    }

    public function store()
    {
        $this->validate();

        DestinationPlant::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'customer_id' => $this->customer_id,
            'country_id' => $this->country_id,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Planta creada exitosamente!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('destination_plant.index');
        $this->resetInputFields();


    }

    private function resetInputFields()
    {
        $this->reset(['name', 'address', 'phone_number', 'status', 'customer_id', 'country_id']);
    }

    public function render()
    {
        return view('livewire.destionation-plant.create-destination-plant');
    }
}
