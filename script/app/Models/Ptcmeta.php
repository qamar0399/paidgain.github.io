<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptcmeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptc_id',
        'key',
        'value'
    ];

    public static function set($ptc_id, $key, $value)
    {
        self::updateOrCreate([
            'ptc_id' => $ptc_id,
            'key' => $key
        ], [
            'key' => $key,
            'value' => $value
        ]);
    }
}
