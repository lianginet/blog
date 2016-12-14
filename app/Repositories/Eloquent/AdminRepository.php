<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Contracts\Repositories\AdminRepository as AdminRepositoryContract;

class AdminRepository extends Repository implements AdminRepositoryContract
{
    /**
     * AdminRepository constructor.
     *
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }
}