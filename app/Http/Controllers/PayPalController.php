<?php

namespace App\Http\Controllers;

use App\Models\ThreeDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function payment($id)
    {
        $model = ThreeDModel::find($id);
        return view("welcome",compact('model'));
    }
    public function download($id){
        $model = ThreeDModel::find($id);
        foreach ($model->files as $file){
            $path = '/models/'.$file->file;

            if(!$file->is_image($path)){
                $file_path= public_path().$path;
                $headers = array(
                    'Content-Type: application/*',
                );
                return Response::download($file_path, $file->file, $headers);
            }
        }
    }

}