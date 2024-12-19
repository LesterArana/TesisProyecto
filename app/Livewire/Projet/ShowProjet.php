<?php

namespace App\Livewire\Projet;

use App\Models\Projet;
use Livewire\Component;

class ShowProjet extends Component
{
    public $projet;

    public function mount(Projet $projet)
    {
        $this->projet = $projet;
    }

    public function render()
    {
        return view('livewire.projet.show-projet');
    }
}
