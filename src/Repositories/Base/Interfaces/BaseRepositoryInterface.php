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

    public function update(array $attributes, int $id): mixed;

    public function updateOrCreate(array $search, array $attributes): mixed;

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'desc'): array|Collection;

    public function find(int $id, array $with = []): mixed;

    public function findOneOrFail(int $id): mixed;

    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed;

    public function findOneBy(array $data, array $with = []): mixed;

    public function findOneByOrFail(array $data): mixed;

    public function paginateArrayResults(array $data, int $perPage = 50): LengthAwarePaginator;

    public function delete(int $id): bool;

    public function whereIn(string $column, array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc'): mixed;
}
