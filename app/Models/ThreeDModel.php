<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDModel extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','price'];


    public function files(){
        return $this->hasMany(File::class);
    }
}