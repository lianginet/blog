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
     * @var \App\Repositories\Eloquent\ArticleRepository
     */
    private $article;

    /**
     * @var \App\Repositories\Eloquent\CategoryRepository
     */
    private $category;

    /**
     * @var \App\Repositories\Eloquent\TagRepository
     */
    private $tag;

    /**
     * ArticleService constructor.
     * @param $article
     * @param Category $category
     * @param Tag $tag
     */
    public function __construct(Article $article, Category $category, Tag $tag)
    {
        $this->article  = $article;
        $this->category = $category;
        $this->tag      = $tag;
    }

    /**
     * Get article list
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getArticles()
    {
        return $this->article->all();
    }

    /**
     * Get article cateogries
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories()
    {
        return $this->article->all();
    }

    /**
     * Get article tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTags()
    {
        return $this->tag->all();
    }
}