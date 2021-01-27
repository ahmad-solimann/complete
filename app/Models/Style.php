<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'number',
    ];
    public function categories(){
        return $this->belongsToMany(Category::class,'category_styles','style_id','category_id');
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
