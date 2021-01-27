<?php

namespace App\Models;

use App\Notifications\RegisteredUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    const SUPER_ADMIN_ROLE = 'SUPER_ADMIN_ROLE';
    const USER_ROLE = 'USER_ROLE';
    const ADMIN_ROLE = 'ADMIN_ROLE';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'user_role', 'verified', 'first_name', 'last_name',
        'address_1', 'address_2', 'emirates_national_id', 'phone', 'city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notificationsCount()
    {
        return $this->unreadNotifications()->count();
    }

    public function getUnreadNotifications()
    {
        return $this->unreadNotifications()->latest()->take(8);
    }

    public function isAdmin()
    {
        if(($this->user_role == User::ADMIN_ROLE) or ($this->user_role == User::SUPER_ADMIN_ROLE))
        return true;
        else
        return false;
    }

    public function verify()
    {
        $this->verified = 1;
        $this->save();
        return;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public static function  AccountCreated($email){
        if(User::where('email','=',$email)->exists()){
            return true;
        }else{
            return false;
        }
    }

    public function questionnaires(){
        return $this->hasMany(Questionnaire::class);
    }
}




