<?php

namespace App\Livewire\Credit;

use App\Models\Credit;
use Livewire\Component;

class ShowCredit extends Component
{
    public $credit;

    public function mount(Credit $credit)
    {
        $this->credit = $credit;

    }
    public function render()
    {
        return view('livewire.credit.show-credit');
    }
}
