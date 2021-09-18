<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    const GENERAL = 'General';
    const RESERVED = 'Reserved';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
