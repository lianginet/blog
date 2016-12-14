<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class TestController extends Controller
{
    private $article;

    public function __construct(ArticleService $article)
    {
        $this->article = $article;
    }

    public function test()
    {
        dd($this->article->getArticles());
    }
}
