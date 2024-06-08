<?php

namespace App\Models\Traits;

use App\Models\Scopes\{LoadCreatedByScope, LoadUpdatedByScope};
use App\Models\User;

trait UserAudit
{
  protected static function booted()
  {
    static::addGlobalScope(new LoadCreatedByScope());
    static::addGlobalScope(new LoadUpdatedByScope());
  }

  public final function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public final function updatedBy()
  {
    return $this->belongsTo(User::class, 'updated_by');
  }
}
