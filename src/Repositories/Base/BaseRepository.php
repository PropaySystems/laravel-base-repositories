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
     */
    public function __construct(
        protected Model $model
    ) {
    }

    public function newModelInstance(): Model
    {
        return new $this->model();
    }

    public function model(): Model
    {
        return $this->model;
    }

    /**
     * @return object
     */
    public function create(array $attributes): mixed
    {
        return $this->model
            ->create($attributes);
    }

    /**
     * @param array $search
     * @param array $attributes
     * @return mixed
     */
    public function firstOrCreate(array $search, array $attributes): mixed
    {
        return $this->model
            ->firstOrCreate($search, $attributes);
    }

    /**
     * @return object
     */
    public function update(array $attributes, int $id): mixed
    {
        // @phpstan-ignore-next-line
        return tap($this->model->find($id))->update($attributes);
    }

    /**
     * @param array $attributes
     * @param string $id
     * @param string $column
     * @return mixed
     */
    public function updateWithUuid(array $attributes, string $id, string $column = 'id'): mixed
    {
        return tap($this->model->where($column, '=', $id))->update($attributes);
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

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): array|Collection
    {
        return $this->model
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get($columns);
    }

    public function find(int $id, array $with = []): mixed
    {
        return $this->model
            ->with($with)
            ->find($id);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(int $id): mixed
    {
        return $this->model
            ->findOrFail($id);
    }

    public function findBy(mixed $attributes, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model
            ->where($attributes)
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get();
    }

    public function findOneBy(array $attributes, array $with = []): mixed
    {
        return $this->model
            ->where($attributes)
            ->with($with)
            ->first();
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $attributes): mixed
    {
        return $this->model
            ->where($attributes)
            ->firstOrFail();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function paginateArrayResults(array $attributes, int $perPage = 50): LengthAwarePaginator
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($attributes, $offset, $perPage, false),
            count($attributes),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model
            ->find($id)
            ->delete();
    }

    /**
     * @param string $column
     * @param array $attributes
     * @param array $with
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function whereIn(string $column, array $attributes, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed
    {
        return $this->model
            ->whereIn($column, $attributes)
            ->with($with)
            ->orderBy($orderBy, $sortBy)
            ->get();
    }
}
