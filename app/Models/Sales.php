<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Sales extends Eloquent
{

    protected $connection = 'mongodb';
    protected $collection = 'sales';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
        'item',
        'price',
        'qty', 
        'grand_total'
    ];
}