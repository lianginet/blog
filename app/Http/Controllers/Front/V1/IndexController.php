<?php

namespace App\Http\Controllers\Front\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function init()
    {
        return [
            'github' => 'https://github.com/lianginet',
        ];
    }
}
