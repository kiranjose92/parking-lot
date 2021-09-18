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

    /**
     * Get the status counts of the parking slots.
     *
     * @param array $filters
     */
    public function getParkingStatus($filters)
    {
        $result = [];
        $parkingCounts = self::all()->pluck('count', 'attribute');
        if (isset($filters['available'])) {
            $result['reserved_slots_available'] = $parkingCounts['reserved_slots'] - $parkingCounts['reserved_slots_booked']
                - $parkingCounts['reserved_slots_occupied'];
            $result['general_slots_available'] = $parkingCounts['general_slots'] - $parkingCounts['general_slots_booked']
                - $parkingCounts['general_slots_occupied'];
            $result['total_slots_available'] = $result['reserved_slots_available'] + $result['general_slots_available'];
        }
        if (isset($filters['occupied'])) {
            $result['reserved_slots_occupied'] = $parkingCounts['reserved_slots_occupied'];
            $result['general_slots_occupied'] = $parkingCounts['general_slots_occupied'];
            $result['total_slots_occupied'] = $result['reserved_slots_occupied'] + $result['general_slots_occupied'];
        }
        if (isset($filters['booked'])) {
            $result['reserved_slots_booked'] = $parkingCounts['reserved_slots_booked'];
            $result['general_slots_booked'] = $parkingCounts['general_slots_booked'];
            $result['total_slots_booked'] = $result['reserved_slots_booked'] + $result['general_slots_booked'];
        }
        if (isset($filters['allotted'])) {
            $result['reserved_slots_allotted'] = $parkingCounts['reserved_slots_booked']
                + $parkingCounts['reserved_slots_occupied'];
            $result['general_slots_allotted'] = $parkingCounts['general_slots_booked']
                + $parkingCounts['general_slots_occupied'];
            $result['total_slots_allotted'] = $result['reserved_slots_allotted'] + $result['general_slots_allotted'];
        }
        return $result;
    }
}
