<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['page_name', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
