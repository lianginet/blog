<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Contracts\Repositories\CategoryRepository as CategoryRepositoryContract;

class CategoryRepository extends Repository implements CategoryRepositoryContract
{
    /**
     * @ var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}