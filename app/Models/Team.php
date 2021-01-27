<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name','job','facebook','twitter','instagram','linked_in','description'];

    public function file(){
        return $this->hasOne(File::class);
    }
}