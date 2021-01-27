<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::all();
        return view('users.Team.index',compact('teams'));
    }
    public function create(){
        return view('users.Team.new');
    }
    public function store(Request $request){
       $team = Team::create($request->only(['name','job','facebook','twitter','instagram','linked_in','description']));
        if ($file = $request->file('file') ){
            $name = $file->getClientOriginalName();
            $file->move('Team',$name);
            $team->file()->create(['file'=>$name]);
        }
        return redirect(route('teams.index'));
    }
    public function edit($id){
        $team = Team::find($id);
        return view('users.Team.edit',compact('team'));
    }
    public function update(Request $request , $id){
//        $this->validate($request,[
//            'name'=>"required",
//            'job'=>"required",
//            'description'=>'required',
//            'file'=>'image|mimes:jpeg,png,jpg|max:2048',
//        ]);
        $team = Team::find($id);
        $team->update($request->only(['name','job','facebook','twitter','instagram','linked_in','description']));
        if ($file = $request->file('file') ){
            $file_path = public_path('Team/'.$team->file->file);
            if (File::exists($file_path)) File::delete($file_path);
            $name = $file->getClientOriginalName();
            $file->move('Team',$name);
            $team->file()->update(['file'=>$name]);

        }
        return redirect()->route('teams.index');
    }
    public function show($id){
        $team = Team::find($id);
        return view('users.Team.show',compact('team'));
    }

    public function destroy($id){
        $team = Team::find($id);
        $file_path = public_path('Team/'.$team->file->file);
        if(File::exists($file_path)) File::delete($file_path);
        $team->file->delete();
        $team->delete();
        return redirect(route('teams.index'));
    }

    public function choice(Request $request){
        $request->validate([
            'teams' => 'required|min:1|max:3'
        ]);
        $teams = $request->input('teams',[]);
        Team::whereNotIn('id',$teams)->update(['choice'=>false]);
        Team::whereIn('id',$teams)->update(['choice'=>true]);
        return redirect(route('teams.index'));
    }


}