<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamMember extends Model
{
    use HasFactory;
    protected $fillable=['name','title','project_id'];

    public function project(){
        $this->belongsTo(Project::class);
    }
}
