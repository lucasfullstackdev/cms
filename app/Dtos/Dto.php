<?php

namespace App\Dtos;

use Illuminate\Support\Collection;

abstract class Dto
{
  public final function toArray(): array
  {
    return array_filter(get_object_vars($this), fn ($value) => !is_null($value));
  }

  public final function toResponse(): array
  {
    return array_map(function ($value) {
      if ($value instanceof Dto) {
        return $value->toArray();
      }

      if ($value instanceof Collection) {
        return $value->map(fn ($item) => $item->toArray());
      }

      return $value;
    }, $this->toArray());
  }
}
