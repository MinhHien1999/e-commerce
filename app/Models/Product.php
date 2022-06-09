<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;

    public $timestamps = true;

    protected $fillable = [
        'title', 'slug', 'description', 'image',
        'quantity', 'price', 'brand_id',
        'cat_id', 'child_cat_id','discount', 'status'

    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getAllProduct(){
        return Product::orderBy('id', 'DESC')->get();
    }
}
