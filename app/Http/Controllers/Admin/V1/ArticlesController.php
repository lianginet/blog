<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function __construct()
    {
        
    }

    public function getArticleRelatedInfo()
    {
        $cateogries = [
            0 => 'Linux',
            1 => 'PHP',
            2 => 'Vuejs',
        ];
        $tags = [
            0 => 'PHP',
            1 => 'Laravel',
            2 => 'Python',
        ];

        return [
            'categories' => $cateogries,
            'tags' => $tags,
        ];
    }

    public function saveArticle(Request $request)
    {
        dd($request->input("article.content"));
        return [
            'id' => 1,
        ];
    }
}
