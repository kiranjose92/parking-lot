<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Different statuses of a booking.
     */
    const BOOKED_STATUS = 'booked';
    const ARRIVED_STATUS = 'arrived';
    const DEPARTED_STATUS = 'departed';
    const CANCELLED_STATUS = 'cancelled';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'booked_at', 'arrived_at', 'departed_at', 'status'];

    /**
     * Get the category of the parking slot allocated.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

     /**
     * Function to book a parking slot for an user.
     *
     * @param App\User $user
     */
    public function bookSlot($user)
    {
        $category = $user->category->name;
        $isSlotAlloted = ParkingCount::bookSlot($category);
        if (!$isSlotAlloted && $category == Category::RESERVED) {
            $category = Category::GENERAL;
            $isSlotAlloted = ParkingCount::bookSlot($category);
        }
        if (!$isSlotAlloted) {
            throw new \Exception('Parking slot not available');
        }
        $this->user_id = $user->id;
        $this->category_id = Category::where('name', $category)->first()->id;
        $this->booked_at = date('Y-m-d H:i:s');
        $this->status = self::BOOKED_STATUS;
        $this->save();
    }
}
