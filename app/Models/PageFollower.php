<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFollower extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'follower_id'];

    public function page(){
        return $this->belongsTo('App\Models\Page', 'page_id')->with('post', 'owner');
    }

    public function follower(){
        return $this->belongsTo('App\Models\User', 'follower_id');
    }
}
