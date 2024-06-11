<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\Dto;

final class TagForUserViewing extends Dto
{
  public function __construct(
    public int $id,
    public string $name,
    public bool $active,
  ) {
  }
}
