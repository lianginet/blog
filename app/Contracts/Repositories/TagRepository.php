<?php

namespace App\Contracts\Repositories;

interface TagRepository
{
    public function updateCount(int $aid, int $num);
}