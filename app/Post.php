<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    protected $fillable = ['title', 'describtion', 'user_id', 'slug', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public static function storePostImage($request)
    {
        $path = $request->file('image')->store('public/images');
        $path = str_replace('public/', '', $path);
        return $path;
    }
    
}
