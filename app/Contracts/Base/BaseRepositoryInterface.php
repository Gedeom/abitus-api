<?php

namespace App\Contracts\Base;

interface BaseRepositoryInterface
{
    public function getAll(int $perPage = 10);
    public function getById(int $id);
    public function create(array $entity);
    public function update(object $entity, array $entityData);
    public function delete(object $entity);
}
