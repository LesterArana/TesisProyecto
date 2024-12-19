<?php

namespace App\Livewire\Projet;

use App\Models\Projet;
use Livewire\Component;
class CreateProjet extends Component
{
    public $name;
    public $address;
    public $status = 1;

    protected $rules = [
        'name' => 'required|max:255',
        'address' => 'required|string',
        'status' => 'required|boolean',
    ];

    public function store()
    {
        $this->validate();

        Projet::create([
            'name' => $this->name,
            'address' => $this->address,
            'status' => $this->status,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Proyecto creado exitosamente!',
        ]);

        return redirect()->route('projets.index');
    }

    public function render()
    {
        return view('livewire.projet.create-projet');
    }
}
