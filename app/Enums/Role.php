<?php

namespace App\Enums;

enum Role: string
{
  case ADMIN = 'admin';
  case WRITTER = 'writter';
  case VIEWER = 'viewer';
}
