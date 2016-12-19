<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

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
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->article->getArticles($request->all());

        return $this->response->paginator($articles, new ArticleTransformer);
    }

    /**
     * 函数说明
     *
     * @return array
     */
    public function create()
    {
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
     * @return array
     */
    public function store(ArticleRequest $request)
    {
        $request = $request->all();
        return $this->article->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(123);
    }

    /**
     * Get the willing edit article and related info
     *
     * @param $id
     * @return array
     */
    public function edit($id)
    {
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
     * @return array
     */
    public function update(ArticleRequest $request, int $id)
    {
        $request = $request->all();
        return $this->article->save($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
