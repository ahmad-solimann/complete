<?php

namespace App\Models;

use App\Notifications\SubmittedQuestionnaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Questionnaire extends Model
{
    use HasFactory;

//    protected $fillable = ['user_id','category_id','style_id','project_name','project_description','project_address','files','links','budget_range'];
      protected $fillable = ['user_id','category_id','style_id','project_address','phone','email','project_description'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function style(){
        return $this->belongsTo(Style::class);
    }
    public function files(){
        return $this->hasMany(File::class);
    }
    public function references(){
        return $this->hasMany(Reference::class);
    }

    protected static function booted()
    {
        static::created(function ($questionnaire) {
            $admins= User::where('user_role',User::ADMIN_ROLE)->orWhere('user_role',User::SUPER_ADMIN_ROLE)->get();
            Notification::send($admins,new SubmittedQuestionnaire($questionnaire));
        });
    }
}
