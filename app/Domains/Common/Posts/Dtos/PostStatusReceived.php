<?php

namespace App\Domains\Common\Posts\Dtos;

use App\Domains\DomainDto;

final class PostStatusReceived extends DomainDto
{
  public function __construct(public int $status_id)
  {
  }
}
