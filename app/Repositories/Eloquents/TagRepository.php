<?php

namespace App\Repositories\Eloquents;

use App\Models\Tag;
use App\Contracts\Repositories\TagRepository as TagRepositoryContract;

class TagRepository extends Repository implements TagRepositoryContract
{
    /**
     * @ var Tag
     */
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
}