<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    const ACTIVE = 1;

    protected $fillable = [
        'name',
        'price',
        'ad_limit',
        'commission',
        'status',
        'days',
        'is_trial',
        'data'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function referralCommission(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function commission()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'plan_id');
    }
}
