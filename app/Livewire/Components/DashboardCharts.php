<?php

namespace App\Livewire\Components;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\Product;  // Importar el modelo Product
use Carbon\Carbon;
use Livewire\Component;

class DashboardCharts extends Component
{
    public $supplierDebts = [];
    public $customerDebts = [];
    public $categorySalesData = [];
    public $productNames = [];
    public $productStocks = [];
    public $totalStock = 0;

    public function mount()
    {
        // Deudas de Proveedores
        $suppliers = Supplier::with(['credits' => function($query) {
            $query->where('status', 1);
        }, 'shoppings' => function($query) {
            $query->where('status', 1);
        }])->get();

        foreach ($suppliers as $supplier) {
            $totalCredits = $supplier->credits->sum('mount');
            $totalShoppings = $supplier->shoppings->sum('total_price');
            $balance = $totalCredits - $totalShoppings;

            $this->supplierDebts[] = [
                'name' => $supplier->person->company_name,
                'balance' => $balance
            ];
        }

        // Deudas de Clientes
        $customers = Customer::with(['sales' => function($query) {
            $query->where('status', 1);
                //->where('liquidity_status', 0)
                //->orWhereNull('liquidity_status');
        }, 'customerPayments' => function($query) {
            $query->where('status', 1);
        }])->get();

        foreach ($customers as $customer) {
            $totalCredits = $customer->sales->sum('total_price');
            $totalCustomerPayments = $customer->customerPayments->sum('total');
            $balance = $totalCredits-$totalCustomerPayments;

            $this->customerDebts[] = [
                'name' => $customer->person->company_name,
                'balance' => $balance
            ];
        }

        // Obtener productos activos y su stock
        $products = Product::where('status', 1)->get();  // Filtrar productos con estado activo (status = 1)

        foreach ($products as $product) {
            $this->productNames[] = $product->name;
            $this->productStocks[] = $product->stock;
            $this->totalStock += $product->stock;
        }
    }

    public function render()
    {
        return view('livewire.components.dashboard-charts', [
            'supplierDebts' => $this->supplierDebts,
            'customerDebts' => $this->customerDebts,
            'categorySalesData' => $this->categorySalesData,
            'productNames' => $this->productNames,
            'productStocks' => $this->productStocks,
            'totalStock' => $this->totalStock

        ]);
    }
}
