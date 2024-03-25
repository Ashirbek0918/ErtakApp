<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Voice extends Model
{
    use HasFactory,Notifiable;
    protected $guarded = ['id'];


    public function feedback(){
        return $this->hasMany(Feedback::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
