<?php

namespace PropaySystems\LaravelReminders\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return mixed
     */
    public function update(array $attributes, int $id): object
    {
        return tap($this->model->find($id))->update($attributes);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return mixed
     */
    public function updateOrCreate(array $search, array $attributes)
    {
        return $this->model->updateOrCreate($search, $attributes);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function all($columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param  int  $id
     * @param  array  $with
     * @return mixed
     */
    public function find(int $id, $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param  int  $id
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param  mixed  $data
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function findBy(mixed $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->where($data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param  array  $data
     * @param  array  $with
     * @return mixed
     */
    public function findOneBy(array $data, array $with = [])
    {
        return $this->model->where($data)->with($with)->first();
    }

    /**
     * @param  array  $data
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @param  array  $data
     * @param  int  $perPage
     * @return LengthAwarePaginator
     */
    public function paginateArrayResults(array $data, int $perPage = 50)
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($data, $offset, $perPage, false),
            count($data),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    /**
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param  array  $data
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function whereIn(string $column, array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->whereIn($column, $data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }
}
