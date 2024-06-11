<?php

namespace App\Domains\Admin\Tags;

use App\Domains\Admin\Tags\Dtos\{TagForUserViewing, TagReceived};
use App\Domains\DomainService;
use App\Models\Model;
use App\Models\Tag;

final class TagService extends DomainService
{
  public function __construct(
    protected Model $model = new Tag(),
    protected string $entity = 'Tag'
  ) {
  }

  public function index()
  {
    $paginate = $this->with(['createdBy'])->paginate();

    $mappedRecords = $paginate->getCollection()->map(function ($record) {
      return new TagForUserViewing(
        id: $record->id,
        name: $record->name,
        active: $record->active,
        createdBy: $record->createdBy,
        updatedBy: $record->updatedBy
      );
    });

    // Atualiza os registros paginados com a nova coleção mapeada
    $paginate->setCollection($mappedRecords);

    return $paginate;
  }

  public function store(TagReceived $tagReceived): ?TagForUserViewing
  {
    $tagCreated = $this->createEntity($tagReceived);

    return new TagForUserViewing(
      id: $tagCreated->id,
      name: $tagCreated->name,
      active: $tagCreated->active
    );
  }

  public function show(string $id): ?TagForUserViewing
  {
    $tag = $this->find($id);

    return new TagForUserViewing(
      id: $tag->id,
      name: $tag->name,
      active: $tag->active,
      createdBy: $tag->createdBy,
      updatedBy: $tag->updatedBy
    );
  }

  public function update(TagReceived $tagReceived, string $id): ?TagForUserViewing
  {
    $tag = $this->updateEntity($tagReceived, $id);

    return new TagForUserViewing(
      id: $tag->id,
      name: $tag->name,
      active: $tag->active
    );
  }

  public function inactivate(string $id): bool
  {
    $tag = $this->find($id);
    $tag->active = false;
    $tag->save();

    return true;
  }

  public function activate(string $id): bool
  {
    $tag = $this->find($id);
    $tag->active = true;
    $tag->save();

    return true;
  }
}
