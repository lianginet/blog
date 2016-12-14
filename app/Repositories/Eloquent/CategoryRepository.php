<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Contracts\Repositories\CategoryRepository as CategoryRepositoryContract;

class CategoryRepository extends Repository implements CategoryRepositoryContract
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}