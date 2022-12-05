<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

     protected $fillable = [
        'ticket_no',
    ];

    public static function boot()
    {
      
        parent::boot();
        static::creating(function($model){
            $model->id=Support::max('id') + 1;
            $model->ticket_no=str_pad($model->id, 7,'0',STR_PAD_LEFT);
        });
        

    } 
        
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function meta()
    {
        return $this->hasMany(Supportmeta::class);
    }
}
