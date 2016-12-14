<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Models\Admin;

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

    public function save()
    {
        $data = [
            'account' => 'root',
            'password' => bcrypt('123456'),
            'token' => bcrypt('123456'),
        ];

        dd(Admin::create($data));
    }
}
