<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Shipment_type;
use App\Models\ShipmentType;
use Illuminate\Database\Seeder;

class ShipmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shipmentTypes = [
            ['name' => 'Cliente'],
            ['name' => 'Proveedor'],
        ];

        foreach ($shipmentTypes as $shipmentType) {
            ShipmentType::create($shipmentType);
        }
    }
}
