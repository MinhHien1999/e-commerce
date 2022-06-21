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
    public static function getAllCategory(){
        return Category::orderBy('id', 'DESC')->get();
    }
    public static function getAllChildCategory(){
        return Category::orderBy('id', 'DESC')->where('is_parent',0)->get();
    }
    public static function getChildByParentId($parent_id){
        return Category::where('parent_id',$parent_id)->orderBy('id','ASC')->pluck('id','title');
    }
}
