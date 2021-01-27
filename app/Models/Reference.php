<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = ['link'];

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
}
