<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\DomainDto;

final class TagReceived extends DomainDto
{
  public function __construct(
    public string $name,
    public ?bool $active = true,
  ) {
  }
}
