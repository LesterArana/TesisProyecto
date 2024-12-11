<?php

namespace App\Livewire\DestionationPlant;


use App\Models\DestinationPlant;
use Livewire\Component;

class ShowDestinationPlant extends Component
{
    public $destinationPlant;

    public function mount(DestinationPlant $destinationPlant)
    {
        $this->destinationPlant = $destinationPlant;

    }

    public function render()
    {
        return view('livewire.destionation-plant.show-destination-plant');
    }
}
