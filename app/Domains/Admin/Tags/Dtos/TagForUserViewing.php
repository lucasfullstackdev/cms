<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\DomainDto;
use App\Dtos\User\UserForUserViewing;
use App\Models\User;

final class TagForUserViewing extends DomainDto
{
  public function __construct(
    public int $id,
    public string $name,
    public bool $active,
    public UserForUserViewing|User $createdBy,
    public UserForUserViewing|User $updatedBy,
  ) {
    $this->createdBy = new UserForUserViewing(
      id: $createdBy->id,
      name: $createdBy->name,
      email: $createdBy->email
    );

    $this->updatedBy = new UserForUserViewing(
      id: $updatedBy->id,
      name: $updatedBy->name,
      email: $updatedBy->email
    );
  }
}
