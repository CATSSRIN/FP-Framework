<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'member_id',
        'name',
        'email',
        'phone',
        'address',
        'status',
        'join_date',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans(): HasMany
    {
        return $this->hasMany(Loan::class)->where('status', 'borrowed');
    }
}
