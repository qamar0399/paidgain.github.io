<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTCUser extends Model
{
    protected $table = 'ptc_user';

    public $timestamps = true;

    use HasFactory;

    public function ptc()
    {
        return $this->belongsTo(Ptc::class, 'ptc_id', 'id');
    }
}
