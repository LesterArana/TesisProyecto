<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Livewire\Component;

class EditPosition extends Component
{
    public $position_id;
    public $name;
    public $description;
    public $salary;
    public $night_extra_hour;
    public $daytime_overtime;
    public $status;

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'nullable|max:500',
        'salary' => 'required|numeric|min:0',
        'night_extra_hour' => 'required|numeric|min:0',
        'daytime_overtime' => 'required|numeric|min:0',
        'status' => 'boolean',
    ];

    public function mount(Position $position)
    {
        $this->position_id = $position->id;
        $this->name = $position->name;
        $this->description = $position->description;
        $this->salary = $position->salary;
        $this->night_extra_hour = $position->night_extra_hour;
        $this->daytime_overtime = $position->daytime_overtime;
        $this->status = $position->status;
    }

    public function update()
    {
        $data = $this->validate();

        $position = Position::findOrFail($this->position_id);
        $position->update($data);

        session()->flash('alert', [
            'type' => 'success',
            'message' => '¡Puesto actualizado con éxito!',
            'position' => 'center',
            'timer' => 6000,
        ]);

        return redirect()->route('positions.index');
    }

    public function render()
    {
        return view('livewire.position.edit-position');
    }
}
