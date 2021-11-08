<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPost extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'post_content'];

    public function postOwner(){
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
