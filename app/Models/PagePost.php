<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagePost extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'post_content'];

    public function postOwner()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
    }
}
