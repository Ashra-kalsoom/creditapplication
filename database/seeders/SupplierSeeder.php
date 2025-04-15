<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('suppliers')->insert([
            [
            'name' => 'South Pointe',
            'template_name' => 'South Pointe',
            'active' => true,
            'description' => 'South Pointe',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Resource Rx',
            'template_name' => 'Resource Rx',
            'active' => true,
            'description' => 'Resource Rx',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Republic',
            'template_name' => 'Republic',
            'active' => true,
            'description' => 'Republic',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Oak',
            'template_name' => 'Oak',
            'active' => true,
            'description' => 'Oak',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'JAMS',
            'template_name' => 'JAMS',
            'active' => true,
            'description' => 'JAMS',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'HS',
            'template_name' => 'HS',
            'active' => true,
            'description' => 'HS',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Greenhill',
            'template_name' => 'Greenhill',
            'active' => true,
            'description' => 'Greenhill',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Drugzone',
            'template_name' => 'Drugzone',
            'active' => true,
            'description' => 'Drugzone',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
            'name' => 'Bonita',
            'template_name' => 'Bonita',
            'active' => true,
            'description' => 'Bonita',
            'created_at' => now(),
            'updated_at' => now()
            ],

        ]);
    }
}
