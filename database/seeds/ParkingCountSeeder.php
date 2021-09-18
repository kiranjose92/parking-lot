<?php

use App\ParkingCount;
use Illuminate\Database\Seeder;

class ParkingCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParkingCount::create([
            'attribute' => 'total_slots',
            'count' => 120
        ]);
        ParkingCount::create([
            'attribute' => 'reserved_slots',
            'count' => 24
        ]);
        ParkingCount::create([
            'attribute' => 'reserved_slots_booked',
            'count' => 0
        ]);
        ParkingCount::create([
            'attribute' => 'reserved_slots_occupied',
            'count' => 0
        ]);
        ParkingCount::create([
            'attribute' => 'general_slots',
            'count' => 96
        ]);
        ParkingCount::create([
            'attribute' => 'general_slots_booked',
            'count' => 0
        ]);
        ParkingCount::create([
            'attribute' => 'general_slots_occupied',
            'count' => 0
        ]);
    }
}
