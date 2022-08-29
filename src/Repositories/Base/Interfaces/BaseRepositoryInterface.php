<?php

namespace PropaySystems\LaravelBaseRepositories\Repositories\Base\Interfaces;

interface BaseRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function updateOrCreate(array $search, array $attributes);

    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'desc');

    public function find(int $id, array $with = []);

    public function findOneOrFail(int $id);

    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc');

    public function findOneBy(array $data, array $with = []);

    public function findOneByOrFail(array $data);

    public function paginateArrayResults(array $data, int $perPage = 50);

    public function delete(int $id): bool;

    public function whereIn(string $column, array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc');
}
