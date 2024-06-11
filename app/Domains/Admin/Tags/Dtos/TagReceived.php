<?php

namespace App\Domains\Admin\Tags\Dtos;

use App\Domains\Dto;

final class TagReceived extends Dto
{
  public function __construct(
    public string $name,
    public ?bool $active = true,
  ) {
  }
}
