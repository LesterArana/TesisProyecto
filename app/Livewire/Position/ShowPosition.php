<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Livewire\Component;

class ShowPosition extends Component
{
    public $position;

    public function mount(Position $position)
    {
        // Cargar el registro específico en la propiedad
        $this->position = $position;
    }

    public function render()
    {
        return view('livewire.position.show-position');
    }
}
