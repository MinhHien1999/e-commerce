<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    //
    use Sluggable;

    public $timestamps = true;

    protected $fillable = [
        'title', 'slug', 'image', 'status'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getAllBrand(){
        return Brand::orderBy('id', 'DESC')->get();
    }
}
