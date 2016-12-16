<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
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
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->article->getArticles($request->all());

        return $this->response->paginator($articles, new ArticleTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param $id
     * @return array
     */
    public function update(ArticleRequest $request,int $id)
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
