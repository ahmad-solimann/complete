<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Designer;
use Illuminate\Http\Request;
use File;
class DesignerController extends Controller
{
    protected function index()
    {
        $designers = Designer::all();
        return view('users.Designer.index',compact('designers'));
    }

    public function create()
    {
        $categories = Category::where('parent_id',1)->get();
        return view('users.Designer.new',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'category_id'=>'required'
        ]);
        $designer = Designer::create($request->only(['title','address','info','project_date','category_id']));
        if ($request->has('file'))
        {
            foreach ($request->file('file') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move('Designer\\'.$designer->id,$name);
                $designer->files()->create(['file'=>$name]);
            }
        }
        return redirect(route('designers.index'));
    }

    public function show($id)
    {
        $designer = Designer::find($id);
        return view('users.Designer.show',compact('designer'));
    }

    public function edit($id){
        $categories = Category::where('parent_id',1)->get();
        $designer = Designer::find($id);
        return view('users.Designer.edit',compact(['designer','categories']));
    }

    public function update(Request $request , $id){
        $designer = Designer::find($id);
        $designer->update($request->only(['title','address','info','project_date','category_id']));
        return redirect(route('designers.index'));
    }
    public function destroy($id){
        $designer = Designer::find($id);
        foreach ($designer->files as $file){
            $file_path = public_path('Designer/'.$designer->id.'/'.$file->file);
            if (File::exists($file_path)) File::delete($file_path);
            $file->delete();
        }
        $designer->delete();
        return redirect(route('designers.index'));
    }
}