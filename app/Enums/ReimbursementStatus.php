<?php

namespace App\Enums;

enum ReimbursementStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
