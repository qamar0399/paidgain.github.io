<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    protected $table = 'categories';
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'other',
        'category_id',
        'featured',
        'menu_status',
        'status',
        'lang',
    ];

}
