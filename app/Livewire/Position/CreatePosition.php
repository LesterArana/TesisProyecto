<?php

namespace App\Livewire\Position;

use Livewire\Component;
use App\Models\Position;

class CreatePosition extends Component
{public $name;
    public $description;
    public $salary;
    public $night_extra_hour;
    public $daytime_overtime;
    public $status = true;

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'nullable|max:500',
        'salary' => 'required|numeric|min:0',
        'night_extra_hour' => 'required|numeric|min:0',
        'daytime_overtime' => 'required|numeric|min:0',
        'status' => 'boolean',
    ];

    public function store()
    {
        $data = $this->validate();

        Position::create($data);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Puesto creado con éxito!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('positions.index');
    }

    public function render()
    {
        return view('livewire.position.create-position');
    }
}
