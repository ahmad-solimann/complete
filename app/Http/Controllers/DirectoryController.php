<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use File;
class DirectoryController extends Controller
{


    public function getDir($name ,$id){
        $path = explode('public\\',$name);
        $folders = Storage::disk('public')->files(end($path));

        return view('users.Dir.view',compact(['folders','name','id']) );
    }

    public function upload(Request $request ,$name ,$id){

        if($files =$request->file('file')){
            foreach ($files as $file){
                $file->move($name,$file->getClientOriginalName());
            }
        }
        return redirect(route('openDir',[$name,$id]));
    }

    public function download($path){
        $file_path= storage_path().'\\app\\public\\'.$path;
        $headers = array(
            'Content-Type: application/pdf',
        );
        $temp = explode('\\',$path);
        return Response::download($file_path,end($temp) , $headers);
    }

    public function read($path){
        $file_path= storage_path().'\\app\\public\\'.$path;
        $headers = array(
            'Content-Type: application/*',
        );
        $temp = explode('\\',$path);
        return Response::file($file_path,$headers);
    }

    public function getPubliclyStorgeFile($filename)
    {
        $path = storage_path().'\\app\\public\\'.$filename;

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;

    }

    public function dirToArray($dir) {
        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                }
                else
                {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}
