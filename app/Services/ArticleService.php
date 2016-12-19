<?php
/**
 * ArticleService.php
 *
 * @author  lianginet<lianginet@gmail.com>
 * @date    2016/12/13 09:34
 */

namespace App\Services;

use App\Contracts\Repositories\ArticleDetailRepository as ArticleDetail;
use App\Contracts\Repositories\ArticleTagRepository as ArticleTag;
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
     * @var \App\Repositories\Eloquent\ArticleTagRepository
     */
    private $articleTag;

    /**
     * @var \App\Repositories\Eloquent\ArticleDetailRepository
     */
    private $articleDetail;

    /**
     * ArticleService constructor.
     * @param $article
     * @param Category $category
     * @param Tag $tag
     */
    public function __construct(Article $article, Category $category, Tag $tag, ArticleTag $articleTag, ArticleDetail $articleDetail)
    {
        $this->article  = $article;
        $this->category = $category;
        $this->tag      = $tag;
        $this->articleTag    = $articleTag;
        $this->articleDetail = $articleDetail;
    }

    /**
     * Get articles
     *
     * @param array $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getArticles(array $request)
    {
        $pageSize = $request['size'] ?: 10;
        $articles = $this->article->paginate($pageSize);
        $articles->each(function ($item) {
            if ($item->cid) {
                $item->category = $item->category()->find($item->cid)->name;
            } else {
                $item->category = '-';
            }
            $articleTags = \App\Models\ArticleTag::where('aid', $item->id)->get();
            $tags = [];
            foreach ($articleTags as $at) {
                $tags[] = $at->tag->name;
            }
            if (count($tags)) {
                $item->tags = implode($tags, ', ');
            } else {
                $item->tags = '-';
            }
            if ($item->created_at) {
                $item->create_time = substr($item->created_at, 0, 10);
            }
            if ($item->updated_at) {
                $item->update_time = substr($item->updated_at, 0, 10);
            }
        });

        return $articles;
    }

    public function getArticleById($aid)
    {
        $article = $this->article->find($aid);
        if ($article->cid) {
            $article->category = $this->category->find($aid)->name;
        }
        // Get article tags
        $articleTags = $this->articleTag->getBy('aid', $aid, ['tid'])->toArray();
        $tagIds = [];
        foreach ($articleTags as $item) {
            $tagIds[] = $item['tid'];
        }
        $tags = $this->tag->getByIds($tagIds)->toArray();
        $temp = [];
        foreach ($tags as $item) {
            $temp[] = $item['name'];
        }
        if (count($temp)) {
            $article->tags = $temp;
        }

        $article->content = $this->articleDetail->findBy('aid', $aid)->content;

        return $article;
    }

    /**
     * Get article cateogries
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories()
    {
        return $this->category->all();
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

    public function save($request, int $aid = 0)
    {
        // Get the article fields
        $data = [
            'title'   => trim($request['title']),
            'is_wiki' => $request['wiki'] === 'true',
            'desc'    => trim($request['desc']),
        ];
        if ($request['category']) {
            $data['cid'] = $this->getCategoryId(trim($request['category']));
        }

        if (0 === $aid) {
            // Create article
            if($article = $this->article->create($data)) {
                $aid = $article->id;
                // Create article detail
                $data = [
                    'aid' => $aid,
                    'content' => trim($request['content']),
                ];
                $this->articleDetail->create($data);
            }
        } else {
            $this->article->update($data, $aid);

            // Update article detail
            $data = [
                'content' => trim($request['content']),
            ];
            $this->articleDetail->updateBy($data, 'aid', $aid);
        }

        if ($aid && ! empty($request['tags'])) {
            $this->setArticleTags($aid, $request['tags']);
        }

        return [
            'aid' => $aid,
        ];
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
        $this->articleTag->deleteOldRow($aid);

        // Add tag for this article
        foreach ($tags as $name) {
            $tid = $this->getTagId(trim($name));
            $data = [
                'aid' => $aid,
                'tid' => $tid,
            ];
            $this->articleTag->createNewRow($data);
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