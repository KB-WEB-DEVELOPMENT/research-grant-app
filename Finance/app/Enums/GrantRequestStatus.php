<?php
  
namespace App\Enums;
  
enum GrantRequestStatus: string
{
    case Approved = 'approved';
    case Rejected = 'rejected';
}
