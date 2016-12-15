<?php

namespace App\Repositories\Eloquent;

use App\Models\ArticleDetail;
use App\Contracts\Repositories\ArticleDetailRepository as ArticleDetailRepositoryContract;

class ArticleDetailRepository extends Repository implements ArticleDetailRepositoryContract
{
    /**
     * ArticleDetailRepository constructor.
     *
     * @param ArticleDetail $articleDetail
     */
    public function __construct(ArticleDetail $articleDetail)
    {
        $this->model = $articleDetail;
    }
}