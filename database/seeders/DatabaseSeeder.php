<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Egulias\EmailValidator\Result\Reason\CommaInDomain;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();}
        $this->call(ContriesSeeder::class);
        $this->call(ShipmentTypesSeeder::class);
       // $this->call(ShoppingTypesSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);


        //   User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
