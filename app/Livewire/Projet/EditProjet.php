<?php

namespace App\Livewire\Projet;

use App\Models\Projet;
use Livewire\Component;

class EditProjet extends Component
{
    public $projet;
    public $name;
    public $address;
    public $status;

    protected $rules = [
        'name' => 'required|max:255',
        'address' => 'required|string',
        'status' => 'required|boolean',
    ];

    public function mount(Projet $projet)
    {
        $this->projet = $projet;
        $this->name = $projet->name;
        $this->address = $projet->address;
        $this->status = $projet->status;
    }

    public function update()
    {
        $this->validate();

        $this->projet->update([
            'name' => $this->name,
            'address' => $this->address,
            'status' => $this->status,
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Proyecto actualizado exitosamente!',
        ]);

        return redirect()->route('projets.index');
    }

    public function render()
    {
        return view('livewire.projet.edit-projet');
    }
}
