<?php

namespace App\Models;

use App\Enums\ReimbursementStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'name',
        'description',
        'amount',
        'file',
        'status',
    ];

    protected $casts = [
        'status' => ReimbursementStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
