<?php

namespace App\Models;

use App\Models\Voice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function voice(){
        return $this->belongsTo(Voice::class);
    }
}
