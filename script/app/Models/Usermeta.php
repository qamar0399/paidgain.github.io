<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'key',
        'value'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'value', 'id');
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public static function set($user_id, $key, $value)
    {
        self::updateOrCreate([
            'user_id' => $user_id,
            'key' => $key
        ], [
            'key' => $key,
            'value' => $value
        ]);
    }
}
