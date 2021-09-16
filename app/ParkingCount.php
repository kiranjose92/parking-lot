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
}
