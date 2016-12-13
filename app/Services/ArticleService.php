<?php
/**
 * ArticleService.php
 *
 * @author  lianginet<lianginet@gmail.com>
 * @date    2016/12/13 09:34
 */

namespace App\Services;

use App\Contracts\Repositories\ArticleRepository as Article;
use App\Contracts\Repositories\CategoryRepository as Category;
use App\Contracts\Repositories\TagRepository as Tag;

class ArticleService
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var Tag
     */
    private $tag;

    public function __construct(Article $article, Category $category, Tag $tag)
    {
        $this->article  = $article;
        $this->category = $category;
        $this->tag      = $tag;
    }

    public function getCategories()
    {

    }

    public function getTags()
    {

    }
}