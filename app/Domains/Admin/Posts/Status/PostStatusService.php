<?php

namespace App\Domains\Admin\Posts\Status;

use App\Domains\Admin\Posts\Status\Dtos\PostStatusForUserViewing;
use App\Domains\Admin\Posts\Status\Dtos\PostStatusReceived;
use App\Domains\DomainService;
use App\Models\Model;
use App\Models\PostStatus;

final class PostStatusService extends DomainService
{
  public function __construct(
    protected Model $model = new PostStatus(),
    protected string $entity = 'Post Status'
  ) {
  }

  public function index()
  {
    $paginate = $this->with(['createdBy'])->paginate();

    $mappedRecords = $paginate->getCollection()->map(function ($record) {
      return new PostStatusForUserViewing(
        id: $record->id,
        name: $record->name,
        createdBy: $record->createdBy,
        updatedBy: $record->updatedBy
      );
    });

    // Atualiza os registros paginados com a nova coleção mapeada
    $paginate->setCollection($mappedRecords);

    return $paginate;
  }

  public function store(PostStatusReceived $postStatusReceived): ?PostStatusForUserViewing
  {
    $tagCreated = $this->createEntity($postStatusReceived);

    return new PostStatusForUserViewing(
      id: $tagCreated->id,
      name: $tagCreated->name,
      createdBy: $tagCreated->createdBy,
      updatedBy: $tagCreated->updatedBy
    );
  }

  public function show(string $id): ?PostStatusForUserViewing
  {
    $tag = $this->find($id);

    return new PostStatusForUserViewing(
      id: $tag->id,
      name: $tag->name,
      createdBy: $tag->createdBy,
      updatedBy: $tag->updatedBy
    );
  }

  public function update(PostStatusReceived $postStatusReceived, string $id): ?PostStatusForUserViewing
  {
    $tag = $this->updateEntity($postStatusReceived, $id);

    return new PostStatusForUserViewing(
      id: $tag->id,
      name: $tag->name,
    );
  }
}
