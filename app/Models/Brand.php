<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    //
    use Sluggable;
    use SoftDeletes;

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
