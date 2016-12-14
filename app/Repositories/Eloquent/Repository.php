<?php

namespace App\Repositories\Eloquent;

class Repository
{
    /**
     * @var \Eloquent
     */
    protected $model;

    public function all()
    {
        return $this->model->all();
    }
}