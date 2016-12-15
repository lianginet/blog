<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $fillable = [
        'aid',
        'tid',
    ];

    /**
     * The articleTag belongsto article
     *
     * @return \App\Models\Tag
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'aid');
    }

    /**
     * The articleTag belongsto tag
     *
     * @return \App\Models\Tag
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tid');
    }
}
