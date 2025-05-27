<?php

namespace Database\Seeders;

use App\Models\VpsPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VpsPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VpsPackage::insert([
            [
                'name' => 'Basic',
                'cpu' => 1,   
                'ram' => 512,
                'storage' => 20,
                'price_per_hour' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard',
                'cpu' => 4,
                'ram' => 2048,
                'storage' => 100,
                'price_per_hour' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'cpu' => 8,
                'ram' => 8192,
                'storage' => 500,
                'price_per_hour' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
