<?php

namespace App\Repositories\Eloquent;

use App\Models\ArticleTag;
use App\Contracts\Repositories\ArticleTagRepository as ArticleTagRepositoryContract;

class ArticleTagRepository extends Repository implements ArticleTagRepositoryContract
{
    /**
     * ArticleTagRepository constructor.
     *
     * @param ArticleTag $articleTag
     */
    public function __construct(ArticleTag $articleTag)
    {
        $this->model = $articleTag;
    }
}