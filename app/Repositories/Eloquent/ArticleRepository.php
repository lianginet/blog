<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Contracts\Repositories\ArticleRepository as ArticleRepositoryContract;

class ArticleRepository extends Repository implements ArticleRepositoryContract
{
    /**
     * ArticleRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function test()
    {

    }
}