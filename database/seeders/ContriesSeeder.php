<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries=[
            ['name' => 'Guatemala', 'postal_code' => 502],
            ['name' => 'El Salvador', 'postal_code' => 503],
            ['name' => 'Honduras', 'postal_code' => 504],
            ['name' => 'Nicaragua', 'postal_code' => 505],
            ['name' => 'Costa Rica', 'postal_code' => 506],
            ['name' => 'Panamá', 'postal_code' => 507],
            ['name' => 'Belice', 'postal_code' => 501],

        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
