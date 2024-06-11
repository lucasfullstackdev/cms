<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\DomainDto;
use App\Dtos\User\UserForUserViewing;

final class TagForUserViewing extends DomainDto
{
  public function __construct(
    public int $id,
    public string $name,
    public bool $active,
    public $createdBy = null,
    public $updatedBy = null,
  ) {
    if (!is_null($createdBy)){
      $this->createdBy = new UserForUserViewing(
        id: $createdBy->id,
        name: $createdBy->name,
        email: $createdBy->email
      );
    }

    if (!is_null($updatedBy)){
      $this->updatedBy = new UserForUserViewing(
        id: $updatedBy->id,
        name: $updatedBy->name,
        email: $updatedBy->email
      );
    }
  }
}
