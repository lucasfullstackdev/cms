<?php

namespace App\Domains;

use App\Exceptions\EloquentException;
use App\Exceptions\NotFoundException;
use App\Models\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class DomainService
{
  protected string $entity = 'Entity';
  protected Model $model;

  public final function destroy(string $id): bool
  {
    return $this->find($id)->delete();
  }

  protected final function find(string $id): Model
  {
    $finded = $this->model->find($id);
    if (is_null($finded)) {
      throw new NotFoundException("$this->entity not found", $id);
    }

    return $finded;
  }

  protected final function createEntity(DomainDto $entity): Model
  {
    try {
      return $this->model->create($entity->toArray());
    } catch (\Exception $e) {
      throw new EloquentException("Error creating $this->entity", $e);
    }
  }

  protected final function updateEntity(DomainDto $entity, string $id): Model
  {
    try {
      $entityToUpdate = $this->find($id);
      $entityToUpdate->update($entity->toArray());
    } catch (\Exception $e) {
      throw new EloquentException("Error updating $this->entity", $e);
    }

    return $entityToUpdate;
  }

  protected final function with(array $relations): self
  {
    $this->model->with($relations);
    return $this;
  }

  protected final function paginate(int $perPage = 10): LengthAwarePaginator
  {
    return $this->model->paginate($perPage);
  }
}
