<?php

namespace App\Domains\Admin\Posts\Status\Dtos;

use App\Domains\DomainDto;

final class PostStatusReceived extends DomainDto
{
  public function __construct(public string $name)
  {
  }
}
