<?php

namespace App\Contracts\Repositories;

interface TagRepository
{
    public function updateCount(int $aid, int $num);
    public function getByIds(array $ids, array $columns = ['*']);
}