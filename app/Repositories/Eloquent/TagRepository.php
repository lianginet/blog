<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Contracts\Repositories\TagRepository as TagRepositoryContract;

class TagRepository extends Repository implements TagRepositoryContract
{
    /**
     * TagRepository constructor.
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Update articleTag count
     *
     * @param int $aid
     * @param int $num
     * @return void
     */
    public function updateCount(int $id, int $num = 1)
    {
        $this->model->where('id', '=', $id)
            ->increment('count', $num);
    }
}