<?php

namespace App\Livewire\TravelExpense;

use App\Models\TravelExpense;
use Livewire\Component;

class ShowTravelExpense extends Component
{
    public $expense;

    public function mount(TravelExpense $travelExpense)
    {
        $this->expense = $travelExpense;
    }

    public function render()
    {
        return view('livewire.travel-expense.show-travel-expense');
    }
}
