<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'commant',
        'charge',
        'rate',
        'status',
        'user_id',
        'currency',
        'withdraw_method_id',
        'invoice_no',
    ];

    public static function boot()
    {
      
        parent::boot();
        static::creating(function($model){
            $model->id=Withdraw::max('id') + 1;
            $model->invoice_no=env('WITHDRAW_PREFIX').str_pad($model->id, 7,'0',STR_PAD_LEFT);
        });
        

    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(WithdrawMethod::class, 'withdraw_method_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
