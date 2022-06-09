<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use Sluggable;
    
    public $timestamps = true;
    
    protected $fillable = [
        'title', 'slug', 'description', 'image','status'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
