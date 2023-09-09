<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'nip',
        'name',
        'position',
        'password',
    ];

    public function reimbursements()
    {
        return $this->hasMany(Reimbursement::class, 'user_id');
    }
}
