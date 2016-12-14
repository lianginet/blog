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
}