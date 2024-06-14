<?php

namespace App\Dtos\User;

use App\Dtos\Dto;

final class UserForUserViewing extends Dto
{
  public function __construct(
    public int $id,
    public string $name,
    public string $email,
  ) {
  }
}
