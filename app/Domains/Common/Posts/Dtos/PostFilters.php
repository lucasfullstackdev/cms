<?php

namespace App\Domains\Common\Posts\Dtos;

use App\Domains\DomainDto;

final class PostFilters extends DomainDto
{
  public array $tags = [];

  public function __construct(?string $tags = null)
  {
    if (!empty($tags)) {
      $this->tags = explode(',', $tags);
    }
  }
}
