<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Sluggable;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'title', 'slug', 'description', 'image',
        'quantity', 'price', 'brand_id',
        'cat_id', 'child_cat_id', 'discount', 'status'

    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }
    public function brand()
    {
        return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
    }
    public static function getAllProduct()
    {
        // return Product::latest('updated_at')->get();
        return Product::orderBy('updated_at', 'DESC')->get();
    }
    public static function getProductCat($cat_id)
    {
        return Product::where(['cat_id' => $cat_id, 'status' => 'active'])->orderBy('id', 'DESC')->paginate(9)->withQueryString();
    }
    public static function getProductDetail($slug)
    {
        return Product::with('category', 'brand')->where(['slug' => $slug, 'status' => 'active'])->firstOrFail();
    }
    public static function getProductById($id)
    {
        return Product::with('category', 'brand')->where(['id' => $id, 'status' => 'active'])->firstOrFail();
    }
}