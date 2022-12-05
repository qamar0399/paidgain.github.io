<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getway(): BelongsTo
    {
        return $this->belongsTo(Getway::class);
    }

    public function depositmeta()
    {
        return $this->hasOne(Depositmeta::class);
    }
}
