<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent
{

    protected $connection = 'mongodb';
    protected $collection = 'vehicle';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
        'engine', 
        'capacity',
        'type', 
        'suspension_type',
        'transmission_type',
        'additional_info',
        'vehicle_type'
    ];
}