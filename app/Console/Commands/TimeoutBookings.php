<?php

namespace App\Console\Commands;

use App\Booking;
use App\Category;
use App\ParkingCount;
use Illuminate\Console\Command;

class TimeoutBookings extends Command
{
 
    /**
     * The time period in which a booked parked spot should be availed.
     */
    const DEFAULT_WAIT_TIME  = '30 minutes';
    const RUSH_HOUR_WAIT_TIME = '15 minutes';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:timeout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the parking bookings that has not been taken in time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $categoryName = $category->name;
            $totalSlots = ParkingCount::where('attribute', $categoryName . '_slots')->first();
            $slotsBooked = ParkingCount::where('attribute', $categoryName . '_slots_booked')->first();
            $slotsOccupied = ParkingCount::where('attribute', $categoryName . '_slots_occupied')->first();
            $allocationPercent = (($slotsBooked->count + $slotsOccupied->count) / $totalSlots->count) * 100;
            if ($allocationPercent < 50) {
                $waitTime = self::DEFAULT_WAIT_TIME;
            } else {
                $waitTime = self::RUSH_HOUR_WAIT_TIME;
            }

            // Cancel bookings that is past the wait time.
            $bookingsCancelledCount = Booking::where('category_id', $category->id)
                ->where('status', Booking::BOOKED_STATUS)
                ->where('booked_at', '<', date('Y-m-d H:i:s', strtotime('-' . $waitTime)))
                ->update(['status' => Booking::CANCELLED_STATUS]);

            // Make those cancelled slots available
            $slotsBooked->count -= $bookingsCancelledCount;
            $slotsBooked->save();
        }
    }
}
