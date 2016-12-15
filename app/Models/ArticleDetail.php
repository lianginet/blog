<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleDetail extends Model
{
    protected $fillable = [
        'aid',
        'content',
    ];
}
