<?php

namespace App\Livewire\Components;

use App\Models\Credit;
use App\Models\CustomerPayment;
use App\Models\PaymentCustomerAccount;
use App\Models\Sale;
use App\Models\Shopping;
use Livewire\Component;

class DashboardCards extends Component
{
    public $credits;
    public $credits_pend;
    public $shopping;
    public $sales;
    public $customerPayment;
    public $inversion;

    public function mount()
    {
        // Corrección del typo en la variable $this->credits
        $this->credits = Credit::where('status', 1)->sum('mount');
        $this->shopping = Shopping::where('status', 1)->sum('total_price');
        $this->credits_pend= $this->credits - $this->shopping;
        $this->sales = Sale::where('status', 1)
            ->where(function($query) {
                $query->where('liquidity_status', 0)
                    ->orWhereNull('liquidity_status');
            })
            ->sum('total_price');

        $this->customerPayment = CustomerPayment::where('status', 1)->sum('total');
        $this->inversion = $this->sales + $this->credits_pend; // Mejora de la legibilidad
    }

    public function render()
    {
        return view('livewire.components.dashboard-cards');
    }
}
