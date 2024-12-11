<?php

namespace App\Livewire\DestionationPlant;

use App\Models\Country;
use App\Models\Customer;
use App\Models\DestinationPlant;
use Livewire\Component;

class EditDestinationPlant extends Component
{
    public $destinationPlantId;
    public $name, $address, $phone_number, $status = 1, $customer_id, $country_id;
    public $customers;
    public $countries;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:13',
            'status' => 'required|boolean',
            'customer_id' => 'required|exists:customers,id',
            'country_id' => 'nullable|exists:countries,id',
        ];
    }

    public function mount(DestinationPlant $destinationPlant)
    {
        $this->customers = Customer::whereHas('person', function($query) {
            $query->where('state', 1);
        })->get();

        $this->countries = Country::all();

        if ($destinationPlant) {
            $this->destinationPlantId = $destinationPlant->id;
            $this->name = $destinationPlant->name;
            $this->address = $destinationPlant->address;
            $this->phone_number = $destinationPlant->phone_number;
            $this->status = $destinationPlant->status;
            $this->customer_id = $destinationPlant->customer->id;
            $this->country_id = $destinationPlant->country_id;

        }
    }


    public function update()
    {
        $this->validate();

        $destinationPlant = DestinationPlant::find($this->destinationPlantId);

        $destinationPlant->name = $this->name;
        $destinationPlant->address = $this->address;
        $destinationPlant->phone_number = $this->phone_number;
        $destinationPlant->status = $this->status;
        $destinationPlant->customer_id = $this->customer_id;
        $destinationPlant->country_id = $this->country_id;

        if ($destinationPlant->isDirty()) {
            $destinationPlant->save();

            session()->flash('alert', [
                'type' => 'success',
                'message' => '¡Planta actualizada exitosamente!',
                'position' => 'center',
                'timer' => 6000,
            ]);
        }
        return redirect()->route('destination_plant.index');
    }

    public function render()
    {
        return view('livewire.destionation-plant.edit-destination-plant');
    }
}
