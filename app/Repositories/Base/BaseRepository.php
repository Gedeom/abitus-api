<?php

namespace App\Repositories\Base;

use App\Contracts\Base\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $entity;

    /**
     * Get all entities
     * @return array
     */
    public function getAll(int $perPage = 10)
    {
        return $this->entity::paginate($perPage);
    }

    /**
     * Select entity by ID
     * @param int $id
     * @return object
     */
    public function getById(int $id)
    {
        $primaryKey = $this->entity::getModel()->getKeyName();
        return $this->entity::where($primaryKey, $id)->first();
    }

    /**
     * Create a new entity
     * @param array $entity
     * @return object
     */
    public function create(array $entity)
    {
        $entity = $this->entity::create($entity);
        return $entity;
    }

    /**
     * Update the entity data
     * @param object $entity
     * @param array $entityData
     * @return object
     */
    public function update(object $entity, array $entityData)
    {
        $entity->update($entityData);
        return $entity;
    }

    /**
     * Delete the entity
     * @param object $entity
     */
    public function delete(object $entity)
    {
        $entity->delete();
    }
}
