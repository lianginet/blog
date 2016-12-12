<?php

namespace App\Repositories\Eloquents;

use App\Models\Article;
use App\Contracts\Repositories\ArticleRepository as ArticleRepositoryContract;

class ArticleRepository extends Repository implements ArticleRepositoryContract
{
    /**
     * @ var Article
     */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}