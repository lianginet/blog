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

    public function createNewRow($data)
    {
        $row = $this->model->create($data);
        $row->tag()->increment('count');
    }

    public function deleteOldRow(int $aid)
    {
        $oldArticleTags = $this->getBy('aid', $aid);

        $oldArticleTags->each(function($item) {
            /**
             * @var $item \App\Models\ArticleTag
             */
            $item->tag()->decrement('count');
            $item->delete();
        });
    }
}