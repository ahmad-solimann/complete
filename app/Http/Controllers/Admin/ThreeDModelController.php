<?php

namespace App\Http\Controllers\Admin;
//use App\Models\File;
use App\Http\Controllers\Controller;
use App\Models\ThreeDModel;
use Illuminate\Http\Request;
use File;
use Validation;
class ThreeDModelController extends Controller
{

    public function index(){
        $models = ThreeDModel::all();

        return view('users.Models.index',compact('models'));
    }
    public function create(){
        return view('users.Models.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'file'=>'required|file|mimes:zip,rar'
        ]);
        $model =  ThreeDModel::create($request->only(['name','description','price']));
        if($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $file->move('models\\'.$model->id,$name);
            $model->files()->create(['file'=> $name]);

        }
        if($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            $file->move('models\\'.$model->id,$name);
            $model->files()->create(['file'=> $name]);
        }
        return redirect(route('model.index'));
    }

    public function edit($id){
        $model = ThreeDModel::find($id);
        return view("users.Models.edit",compact('model'));
    }

    public function update(Request $request , $id){
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            'file'=>'file|mimes:zip,rar'
        ]);
        $model = ThreeDModel::find($id);
        $model->update($request->only(['name','description','price']));
        if($file = $request->file('image')){
            foreach ($model->files as $file_store) {
                if($file_store->is_image('models/'.$model->id.'/' . $file_store->file)){
                    $file_path = public_path('models/'.$model->id.'/' . $file_store->file);
                    if (File::exists($file_path)) File::delete($file_path);
                    $name = $file->getClientOriginalName();
                    $file->move('models\\'.$model->id, $name);
                    $file_store->update(['file' => $name]);
                }
            }
        }
        if($file = $request->file('file')){
            foreach ($model->files as $file_store) {
                if(!$file_store->is_image('models/' . $file_store->file)){
                    $file_path = public_path('models/' . $file_store->file);
                    if (File::exists($file_path)) File::delete($file_path);
                    $name = $file->getClientOriginalName();
                    $file->move('models', $name);
                    $file_store->update(['file' => $name]);
                }
            }

        }
        return redirect(route('model.index'));
    }
    public function destroy($id){
        $model = ThreeDModel::find($id);
        foreach ($model->files as $file){
            $file_path = public_path('models/'.$model->id."/".$file->file);
            if(File::exists($file_path)) File::delete($file_path);
            $file->delete();
        }
        $model->delete();
        return redirect(route('model.index'));
    }
}