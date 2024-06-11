<?php

namespace App\Domains\Admin\Tags;

use App\Domains\Admin\Tags\Dtos\{TagForUserViewing, TagReceived};
use App\Models\Tag;

final class TagService
{
  public function __construct(private Tag $tag)
  {
  }

  public function store(TagReceived $tagReceived): ?TagForUserViewing
  {
    try {
      $tagCreated = $this->tag->create($tagReceived->toArray());
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }

    return new TagForUserViewing(
      id: $tagCreated->id,
      name: $tagCreated->name,
      active: $tagCreated->active
    );
  }
}
