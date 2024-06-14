<?php

namespace App\Enums;

enum PostStatus: string
{
  case PUBLISHED = 'Published';
  case DRAFT = 'Draft';
  case PENDING_REVIEW = 'Pending Review';
  case SCHEDULED = 'Scheduled';
  case ARCHIVED = 'Archived';
}
