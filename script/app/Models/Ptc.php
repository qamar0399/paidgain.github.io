<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Ptc extends Model
{
    use HasFactory;

    public function getViewedAttribute(): int
    {
        return $this->logs()->count();
    }

    public function getRemainsAttribute(): int
    {
        return ($this->max_limit - $this->logs()->count());
    }

    public function logs(): HasMany
    {
        return $this->hasMany(PTCUser::class, 'ptc_id', 'id');
    }

    public function meta(): HasOne
    {
        return $this->hasOne(Ptcmeta::class);
    }

     public function preview(): HasOne
    {
        return $this->hasOne(Ptcmeta::class)->where('key','image');
    }

    public function getMeta($key)
    {
        return optional($this->hasOne(Ptcmeta::class, 'ptc_id', 'id')
            ->where('key', '=', $key)->first())->value;
    }
}
