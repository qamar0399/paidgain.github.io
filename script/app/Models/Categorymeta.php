<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorymeta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'type',
        'value',

    ];

    public static function set($category_id, $type, $value): Model|Categorymeta
    {
        return self::updateOrCreate([
            'category_id' => $category_id,
            'type' => $type
        ], [
            'type' => $type,
            'value' => $value
        ]);
    }
}
