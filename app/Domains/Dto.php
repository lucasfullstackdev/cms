<?php

namespace App\Domains;

abstract class Dto
{
  public final function toArray(): array
  {
    return get_object_vars($this);
  }
}
