<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'desc',
        'cid',
        'is_wiki',
        'views',
        'status',
        'published_at',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'cid');
    }
}
