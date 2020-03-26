<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'describtion',
        'user_id'
    ];
    function user(){
        return $this->belongsTo('App\User');
    }
    
}
