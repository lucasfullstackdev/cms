<?php

namespace App\Domains\Common\Posts\Dtos;

use App\Domains\DomainDto;

final class PostTagsReceived extends DomainDto
{
  public function __construct(public array $tags = [])
  {
  }
}
