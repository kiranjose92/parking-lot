<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingCount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['attribute', 'count'];


    /**
     * Book a parking slot for a category, if avaiable.
     *
     * @param string $category
     */
    public static function bookSlot($category)
    {
        $category = strtolower($category);
        $totalSlots = self::where('attribute', $category . '_slots')->first();
        $slotsBooked = self::where('attribute', $category . '_slots_booked')->first();
        $slotsOccupied = self::where('attribute', $category . '_slots_occupied')->first();
        if ($totalSlots->count > $slotsBooked->count + $slotsOccupied->count) {
            $slotsBooked->count += 1;
            $slotsBooked->save();
            return true;
        } else {
            return false;
        }
    }
}
