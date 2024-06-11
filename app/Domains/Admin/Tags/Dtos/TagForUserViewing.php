<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\DomainDto;
use App\Domains\Dto;

final class TagForUserViewing extends DomainDto
{
  public function __construct(
    public int $id,
    public string $name,
    public bool $active,
  ) {
  }
}
