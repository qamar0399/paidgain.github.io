<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_limit',
        'max_limit',
        'delay',
        'fixed_charge',
        'rate',
        'percent_charge',
        'currency',
        'user_data',
        'instruction',
        'status',
    ];

    protected $casts = [
        'user_data' => 'json'
    ];

    public function withdraws()
    {
        
        return $this->hasMany(Withdraw::class);
    }
}
