<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = ['title','address','info','project_date','category_id'];

    public function files(){
        return $this->hasMany(File::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}