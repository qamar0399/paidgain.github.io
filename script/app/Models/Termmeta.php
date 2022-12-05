<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termmeta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'term_id',
        'key',
        'value'
    ];

    public static function set($term_id, $key, $value): Model|Termmeta
    {
        return self::updateOrCreate([
            'term_id' => $term_id,
            'key' => $key
        ], [
            'key' => $key,
            'value' => $value
        ]);
    }
}
