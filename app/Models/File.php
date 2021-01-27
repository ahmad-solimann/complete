<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file'];

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
    public function designer(){
        return $this->belongsTo(Designer::class);
    }
    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function threeDModel(){
        return $this->belongsTo(ThreeDModel::class);
    }

    function is_image($image)
    {
        $path = public_path().$image;
        $file_type = explode('.',$path)[1];
        $check_type = ['zip','rar','txt','pdf'];
        if(in_array($file_type,$check_type)){
            return false;
        }
        return true;
    }
}