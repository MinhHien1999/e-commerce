<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'type', 'price', 'status',
    ];

}