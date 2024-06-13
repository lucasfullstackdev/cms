<?php

namespace App\Domains\Common\Posts\Dtos;

use App\Domains\DomainDto;

final class PostReceived extends DomainDto
{
  public function __construct(
    public string $title,
    public string $content,
    public int $status_id,
    public array $tags = [],
  ) {
  }
}
