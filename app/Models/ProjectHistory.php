<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHistory extends Model
{
    protected $fillable = ['admin_id','project_id','message_content'];
    use HasFactory;
}
