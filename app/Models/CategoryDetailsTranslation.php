<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetailsTranslation extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
    ];
    public $timestamps = false;


    public function categoryDetails(){
        return $this->belongsTo(CategoryDetails::class);
    }
}
