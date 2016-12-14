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
use Illuminate\Http\Request;

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
        $this->article = $article;
        $this->category = $category;
        $this->tag = $tag;
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

    /**
     * 函数说明
     *
     * @return void
     */
    public function saveArticle(Request $request)
    {
//        $this->article->update();
    }

    public function create($request)
    {
        // Get the article fields
        $data = [
            'title'   => $request['title'],
            'is_wiki' => $request['wiki'] === 'true',
        ];
        if ($request['publishedAt']) {
            $data['published_at'] = $request['publishedAt'];
        }
        if ($request['category']) {
            $data['cid'] = $this->getCategoryId(trim($request['category']));
        }

        // Create article
        if(!$article = $this->article->create($data)) {
            return 0;
        }
        if ($request['tags']) {
            $this->setArticleTags($article->id, trim($request['tags']));
        }
    }

    /**
     * Get category id by name
     *
     * @param $name
     * @return int|mixed
     */
    public function getCategoryId($name)
    {
        if ($category = $this->category->findBy('name', $name, ['id'])) {
            return $category->id;
        }
        return 0;
    }

    private function setArticleTags($aid, $tags)
    {
        foreach ($tags as $index => $name) {
            if ($tag = $this->tag->findBy('name', $name, ['id'])) {
                $tid = $tag->id;
            } else {
                $this->tag->create([
                    'name' => $name,
                ]);
            }

        }
    }
}