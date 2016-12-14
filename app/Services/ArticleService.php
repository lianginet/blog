<?php
/**
 * ArticleService.php
 *
 * @author  lianginet<lianginet@gmail.com>
 * @date    2016/12/13 09:34
 */

namespace App\Services;

use App\Contracts\Repositories\ArticleTagRepository as ArticleTag;
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
     * @var \App\Repositories\Eloquent\ArticleTagRepository
     */
    private $articleTag;

    /**
     * ArticleService constructor.
     * @param $article
     * @param Category $category
     * @param Tag $tag
     */
    public function __construct(Article $article, Category $category, Tag $tag, ArticleTag $articleTag)
    {
        $this->article = $article;
        $this->category = $category;
        $this->tag = $tag;
        $this->articleTag = $articleTag;
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
     * Set article tags
     *
     * @param $aid
     * @param $tags
     * @return void
     */
    private function setArticleTags($aid, $tags)
    {
        // Delete this article's tag
        $this->articleTag->deleteBy('aid', $aid);

        // Add tag for this article
        foreach ($tags as $index => $name) {
            $tid = $this->getTagId($name);
            $data = [
                'aid' => $aid,
                'tid' => $tid,
            ];
            $this->articleTag->create($data);
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
            $cid =  $category->id;
        } else {
            $cid = $this->category->create([
                'name' => $name,
            ])->id;
        }

        return $cid;
    }

    /**
     * Get tag id by name
     *
     * @param $name
     * @return mixed
     */
    private function getTagId($name)
    {
        if ($tag = $this->tag->findBy('name', $name)) {
            $tid = $tag->id;
        } else {
            $tid = $this->tag->create([
                'name' => $name,
            ])->id;
        }

        return $tid;
    }
}