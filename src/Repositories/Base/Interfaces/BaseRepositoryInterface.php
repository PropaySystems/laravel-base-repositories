<?php

namespace PropaySystems\LaravelBaseRepositories\Repositories\Base\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function newModelInstance(): Model;

    public function model(): Model;

    public function create(array $attributes): mixed;

    public function firstOrCreate(array $search, array $attributes): mixed;

    public function update(array $attributes, int $id): mixed;

    public function updateWithUuid(array $attributes, string $id, string $column = 'id'): mixed;

    public function updateWhere(array $where, array $attributes): int;

    public function updateOrCreate(array $search, array $attributes): mixed;

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): Collection|array;

    public function find(int $id, array $with = []): mixed;

    public function findOneOrFail(int $id): mixed;

    public function findBy(array $attributes, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed;

    public function findOneBy(array $attributes, array $with = []): mixed;

    public function findOneByOrFail(array $attributes): mixed;

    public function findWhereLike(string $attribute, int|string $value, string $orderBy = 'id', string $sortBy = 'asc'): Collection|array;

    public function paginateArrayResults(array $attributes, int $perPage = 50): LengthAwarePaginator;

    public function delete(int $id, bool $forceDelete = false): bool;

    public function deleteWhere(array $data, bool $forceDelete = false): bool;

    public function whereIn(string $column, array $attributes, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed;
}
