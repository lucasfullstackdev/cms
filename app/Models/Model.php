<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
  protected $hidden = [
    'created_at',
    'updated_at',
    'deleted_at',
    'pivot'
  ];

  public function createdAt(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => $this->formatDateTime($value),
    );
  }

  public function updatedAt(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => $this->formatDateTime($value),
    );
  }

  public function deletedAt(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => $this->formatDateTime($value),
    );
  }

  protected final function formatDateTime($value): ?string
  {
    if (is_null($value)) {
      return null;
    }

    return date('d/m/Y H:i:s', strtotime($value));
  }
}
