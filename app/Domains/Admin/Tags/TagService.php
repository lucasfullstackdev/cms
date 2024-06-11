<?php

namespace App\Domains\Admin\Tags;

use App\Domains\Admin\Tags\Dtos\{TagForUserViewing, TagReceived};
use App\Dtos\User\UserForUserViewing;
use App\Exceptions\StoreException;
use App\Models\Tag;

final class TagService
{
  public function __construct(private Tag $tag)
  {
  }

  public function index()
  {
    $paginate = $this->tag->with('createdBy')->paginate();

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
    try {
      $tagCreated = $this->tag->create($tagReceived->toArray());
    } catch (\Exception $e) {
      throw new StoreException(
        message: 'An error occurred while creating the tag',
        errors: $e->getMessage(),
        data: $tagReceived
      );
    }

    return new TagForUserViewing(
      id: $tagCreated->id,
      name: $tagCreated->name,
      active: $tagCreated->active
    );
  }
}
