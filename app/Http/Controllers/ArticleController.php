<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Models\Admin;

class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $article;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $article
     */
    public function __construct(ArticleService $article)
    {
        $this->article = $article;
    }

    /**
     * 函数说明
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response|int
     */
    public function index(Request $request)
    {
        if (!$this->validateToken()) {
            return -1;
        }
        $articles = $this->article->getArticles($request->all());

        return $this->response->paginator($articles, new ArticleTransformer);
    }

    /**
     * 函数说明
     *
     * @return array|int
     */
    public function create()
    {
        if (!$this->validateToken()) {
            return -1;
        }

        $categories = $this->article->getCategories();
        $tags       = $this->article->getTags();

        return [
            'categories' => $categories,
            'tags'       => $tags,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return array|int
     */
    public function store(ArticleRequest $request)
    {
        if (!$this->validateToken()) {
            return -1;
        }

        $request = $request->all();
        return $this->article->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|int
     */
    public function show($id)
    {
        if (!$this->validateToken()) {
            return -1;
        }

        return $this->article->getArticleById($id);
    }

    /**
     * Get the willing edit article and related info
     *
     * @param $id
     * @return array|int
     */
    public function edit($id)
    {
        if (!$this->validateToken()) {
            return -1;
        }

        $categories = $this->article->getCategories();
        $tags       = $this->article->getTags();
        $article    = $this->article->getArticleById($id);

        return [
            'article'    => $article,
            'categories' => $categories,
            'tags'       => $tags,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param int $id
     * @return array|int
     */
    public function update(ArticleRequest $request, int $id)
    {
        if (!$this->validateToken()) {
            return -1;
        }

        $request = $request->all();
        return $this->article->save($request, $id);
    }

    public function destroy($id)
    {
        if (!$this->validateToken()) {
            return -1;
        }

        return $this->article->deleteArticleById($id);
    }

    public function validateToken()
    {
        $token = request('token');
        if (!$token || !Admin::whereToken($token)->first()) {
            return false;
        }
        return true;
    }
}
