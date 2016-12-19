<?php

namespace App\Repositories\Eloquent;

class Repository
{
    /**
     * @var \Eloquent
     */
    protected $model;

    /**
     * Get all the rows
     *
     * @param array $cloumns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $cloumns = ['*'])
    {
        return $this->model->all($cloumns);
    }

    /**
     * Find the row by id
     *
     * @param string|int $id
     * @param array $columns
     * @return \Eloquent|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find(string $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Get all the rows
     *
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Get the row by attribute
     *
     * @param string $attr
     * @param string $value
     * @param array $columns
     * @return \Eloquent|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findBy(string $attr, string $value, array $columns = ['*'])
    {
        return $this->model
            ->where($attr, '=', $value)
            ->first($columns);
    }

    /**
     * Get the rows by attribute
     *
     * @param string $attr
     * @param string $value
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBy(string $attr, string $value, array $columns = ['*'])
    {
        return $this->model
            ->where($attr, '=', $value)
            ->get($columns);
    }

    /**
     * 函数说明
     *
     * @param int $num
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $num, array $columns = ['*'])
    {
        return $this->model->paginate($num, $columns);
    }

    /**
     * 函数说明
     *
     * @param array $data
     * @return \Eloquent
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     *
     *
     * @param array $data
     * @param string $id
     * @return bool
     */
    public function update(array $data, string $id)
    {
        return $this->model
            ->where('id', '=', $id)
            ->update($data);
    }

    /**
     * Update the row which
     *
     * @param $data
     * @param string $attr
     * @param string $value
     * @return bool
     */
    public function updateBy($data, string $attr, string $value)
    {
        return $this->model
            ->where($attr, '=', $value)
            ->update($data);
    }

    /**
     * Delete the row by id
     *
     * @param $id
     * @param bool $delete
     * @return bool|null
     */
    public function delete($id, $delete = true)
    {
        if ($delete === true) {
            return $this->model
                ->where('id', '=', $id)
                ->delete();
        } else {
            return $this->model
                ->where('id', '=', $id)
                ->update(['status' => -1]);
        }
    }

    /**
     * Delete the row by attribute
     *
     * @param string $attr
     * @param string $value
     * @param bool $delete
     * @return bool|null
     */
    public function deleteBy(string $attr, string $value, $delete = true)
    {
        if ($delete === true) {
            return $this->model
                ->where($attr, '=', $value)
                ->delete();
        } else {
            return $this->model
                ->where($attr, '=', $value)
                ->update(['status' => -1]);
        }
    }

    /**
     * Get count by attr
     *
     * @param string $attr
     * @param string $value
     * @return int
     */
    public function getCountBy(string $attr, string $value)
    {
        return $this->model
            ->where($attr, '=', $value)
            ->count();
    }
}