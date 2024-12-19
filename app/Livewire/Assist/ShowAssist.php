<?php

namespace App\Livewire\Assist;

use App\Models\Assist;
use Livewire\Component;

class ShowAssist extends Component
{
    public $assist;

    public function mount(Assist $assist)
    {
        $this->assist = $assist;
    }

    public function render()
    {
        return view('livewire.assist.show-assist');
    }
}
