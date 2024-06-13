<?php

namespace App\Domains\Common\Posts\Dtos;

use App\Domains\Admin\Posts\Status\Dtos\PostStatusForUserViewing;
use App\Domains\Admin\Tags\Dtos\TagForUserViewing;
use App\Domains\DomainDto;
use App\Dtos\User\UserForUserViewing;
use App\Models\PostStatus;
use Illuminate\Support\Collection;

final class PostForUserViewing extends DomainDto
{
  public function __construct(
    public int $id,
    public string $title,
    public string $slug,
    public string $content,
    public PostStatus|PostStatusForUserViewing $status,
    public Collection|TagForUserViewing $tags,
    public $createdBy = null,
    public $updatedBy = null,
  ) {
    if ($status instanceof PostStatus) {
      $this->status = new PostStatusForUserViewing(
        id: $status->id,
        name: $status->name
      );
    }

    if ($tags instanceof Collection) {
      $this->tags = $tags->map(function ($tag) {
        return new TagForUserViewing(
          id: $tag->id,
          name: $tag->name,
          active: $tag->active
        );
      });
    }

    if (!is_null($createdBy)) {
      $this->createdBy = new UserForUserViewing(
        id: $createdBy->id,
        name: $createdBy->name,
        email: $createdBy->email
      );
    }

    if (!is_null($updatedBy)) {
      $this->updatedBy = new UserForUserViewing(
        id: $updatedBy->id,
        name: $updatedBy->name,
        email: $updatedBy->email
      );
    }
  }
}
