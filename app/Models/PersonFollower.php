<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonFollower extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'follower_id'];

    public function person(){
        return $this->belongsTo('App\Models\User', 'person_id')->with('post');
    }

    public function follower(){
        return $this->belongsTo('App\Models\User', 'follower_id');
    }
}
