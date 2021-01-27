<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetails extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $fillable =[
        'has_styles',
        //'name',
        //'description',
    ];
    public $translatedAttributes = ['name', 'description'];


    public function styles(){
        return $this->hasMany(Style::class);
    }
    public function categories(){
        return $this->hasOne(Category::class);
    }

    public function categoryDetailsTranslations(){
        return $this->hasMany(CategoryDetailsTranslation::class);
    }

}