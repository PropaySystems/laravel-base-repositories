<?php

namespace PropaySystems\LaravelBaseRepositories\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BaseRepository
{
    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(
        protected Model $model
    ) {
    }

    /**
     * @return Model
     */
    public function newModelInstance(): Model
    {
        return new $this->model();
    }

    /**
     * @return Model
     */
    public function model(): Model
    {
        return $this->model;
    }

    /**
     * @param  array  $attributes
     * @return object
     */
    public function create(array $attributes): mixed
    {
        return $this->model
            ->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return object
     */
    public function update(array $attributes, int $id): mixed
    {
        // @phpstan-ignore-next-line
        return tap($this->model->find($id))->update($attributes);
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return mixed
     */
    public function updateOrCreate(array $search, array $attributes): mixed
    {
        return $this->model
            ->updateOrCreate($search, $attributes);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): array|Collection
    {
        return $this->model
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get($columns);
    }

    /**
     * @param  int  $id
     * @param  array  $with
     * @return mixed
     */
    public function find(int $id, array $with = []): mixed
    {
        return $this->model
            ->with($with)
            ->find($id);
    }

    /**
     * @param  int  $id
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(int $id): mixed
    {
        return $this->model
            ->findOrFail($id);
    }

    /**
     * @param  mixed  $data
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function findBy(mixed $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model
            ->where($data)
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get();
    }

    /**
     * @param  array  $data
     * @param  array  $with
     * @return mixed
     */
    public function findOneBy(array $data, array $with = []): mixed
    {
        return $this->model
            ->where($data)
            ->with($with)
            ->first();
    }

    /**
     * @param  array  $data
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data): mixed
    {
        return $this->model
            ->where($data)
            ->firstOrFail();
    }

    /**
     * @param  array  $data
     * @param  int  $perPage
     * @return LengthAwarePaginator
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function paginateArrayResults(array $data, int $perPage = 50): LengthAwarePaginator
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
        return $this->model
            ->find($id)
            ->delete();
    }

    /**
     * @param  string  $column
     * @param  array  $data
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function whereIn(string $column, array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model
            ->whereIn($column, $data)
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get();
    }
}
