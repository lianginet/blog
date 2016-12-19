<?php

namespace App\Contracts\Repositories;

interface ArticleRepository
{
    public function paginate(int $num, array $columns = ['*']);
}