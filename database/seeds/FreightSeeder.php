<?php

use Illuminate\Database\Seeder;
use App\Models\Freight;
use Illuminate\Support\Str;

class FreightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Freight::create([
            'freight_details'=>Str::random(50),
            'status'=>Str::random(1),
            'user_id'=>Str::random(1),
            'phone'=>Str::random(12),
            'longitude'=>Str::random(50),
            'latitude'=>Str::random(50),
            'address'=>Str::random(50),
            'driver_id'=>Str::random(1),
        ]);
        factory(Freight::class,50)->create();
    }
}
