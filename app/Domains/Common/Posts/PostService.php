<?php

namespace App\Domains\Common\Posts;

use App\Domains\Common\Posts\Dtos\{PostFilters, PostForUserViewing, PostReceived};
use App\Domains\DomainService;
use App\Models\{Model, Post};

final class PostService extends DomainService
{
  public function __construct(
    protected Model $model = new Post(),
    protected string $entity = 'Post'
  ) {
    parent::__construct();
  }

  public function index(PostFilters $filters)
  {
    $paginate = $this->with(['createdBy', 'status', 'tags']);

    if (!empty($filters->tags)) {
      $paginate = $paginate->whereHas('tags', function ($query) use ($filters) {
        $query->whereIn('tags.id', $filters->tags);
      });
    }

    $paginate = $paginate->paginate();

    $mappedRecords = $paginate->getCollection()->map(fn ($record) => $this->PostForUserViewing($record));

    // Atualiza os registros paginados com a nova coleção mapeada
    $paginate->setCollection($mappedRecords);

    return $paginate;
  }

  public function store(PostReceived $postReceived): ?array
  {
    $postCreated = $this->createEntity($postReceived);
    $postCreated->tags()->sync($postReceived->tags);

    return $this->PostForUserViewing($postCreated);
  }

  public function show(string $id): ?array
  {
    return $this->PostForUserViewing(
      $this->find($id)
    );
  }

  public function update(PostReceived $postReceived, string $id): ?array
  {
    $postUpdated = $this->updateEntity($postReceived, $id);
    $postUpdated->tags()->sync($postReceived->tags);

    return $this->PostForUserViewing($postUpdated);
  }

  public function updateTags($request, string $id): ?array
  {
    $post = $this->find($id);
    $post->tags()->sync($request->tags);

    return $this->PostForUserViewing($post);
  }

  public function updateStatus($request, string $id): ?array
  {
    $post = $this->find($id);
    $post->status_id = $request->status_id;
    $post->save();

    return $this->PostForUserViewing($post);
  }

  private function PostForUserViewing(Post $post)
  {
    return (new PostForUserViewing(
      id: $post->id,
      title: $post->title,
      slug: $post->slug,
      content: $post->content,
      status: $post->status,
      tags: $post->tags,
      createdBy: $post->createdBy,
      updatedBy: $post->updatedBy
    ))->toResponse();
  }
}
