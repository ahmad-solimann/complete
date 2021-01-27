<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable =['user_id','category_id','style_id','name','address',
        'execution_time','start_date','end_date','project_director','closed'];
    use HasFactory;
    public function closeProject(){
        $this->closed = 1;
        $this->save();
    }
    public function restoreProject(){
        $this->closed = 0;
        $this->save();
    }
    public function projectHistory(){
        return $this->hasMany(ProjectHistory::class);
    }
    public function teamMembers(){
       return $this->hasMany(TeamMember::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function style(){
        return $this->belongsTo(Style::class);
    }
}
