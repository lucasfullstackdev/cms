<?php

namespace App\Domains\Admin;

use App\Domains\BaseRequest;
use Illuminate\Support\Facades\Auth;

abstract class AdminRequest extends BaseRequest
{
  public function authorize(): bool
  {
    return Auth::user() && Auth::user()->isAdmin();
  }
}
