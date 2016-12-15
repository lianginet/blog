<?php

namespace App\Contracts\Repositories;

interface ArticleTagRepository
{
    public function deleteOldRow(int $aid);
}