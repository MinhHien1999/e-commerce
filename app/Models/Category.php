<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sluggable;
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'title', 'slug', 'is_parent', 'parent_id','status'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function product(){
        return $this->hasMany('App\Models\Product','cat_id','id');
    }
    public static function getAllCategory(){
        return Category::orderBy('id', 'DESC')->get();
    }
    public static function getCategory($slug){
        return Category::where(['status' => 'active', 'slug' => $slug])->firstOrFail();
    }
    public static function getAllChildCategory(){
        return Category::orderBy('id', 'DESC')->where('is_parent',0)->get();
    }
    public static function getChildByParentId($parent_id){
        return Category::where('parent_id',$parent_id)->orderBy('id','ASC')->pluck('id','title');
    }
    public static function getStatusActive(){
        return Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->limit(6)->get();
    }
    public static function getChildStatusActive($parent_id){
        return Category::where(['status' => 'active', 'is_parent' => 0, 'parent_id' => $parent_id])->orderBy('id', 'DESC')->get();
    }
}
