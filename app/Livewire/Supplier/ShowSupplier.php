<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class ShowSupplier extends Component
{
    public $supplier;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier->load('person');
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}