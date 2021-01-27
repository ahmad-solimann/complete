<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\User;
use App\Notifications\SubmittedQuestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;
use Notification;
class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.Questionnaires.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = rand(1000000,99999999);

        if(!Auth::check() ){
            $user = "";
            if(!User::AccountCreated($request->email)){
                $user = User::create([
                    "username"=>explode('@',$request->email)[0],
                    "email"=> $request->email,
                    "password"=>Hash::make($password),
                    "phone"=>$request->phone
                ]);
                $questionnaire = $user->questionnaires()->create([
                    'category_id'=> $request->category_id,
                    'style_id'=> $request->style_id,
                    'project_address'=> $request->address,
                    'project_description'=> $request->description,
                ]);
            }else{
                $user = User::where('email',$request->email)->first();
                $questionnaire = $user->questionnaires()->create([
                    'category_id'=> $request->category_id,
                    'style_id'=> $request->style_id,
                    'project_address'=> $request->address,
                    'project_description'=> $request->description,
                ]);
            }

            if ($files =$request->file('files')){
                foreach ($files as $file){
                    $fileName = $file->getClientOriginalName();
                    $file->move('upload\\'.$questionnaire->id, $fileName);
                    $questionnaire->files()->create([
                        'file'=>$fileName
                    ]);
                }
            }

        }else{
            $questionnaire =  Auth::user()->questionnaires()->create([
                'category_id'=> $request->category_id,
                'style_id'=> $request->style_id,
                'project_address'=> $request->address,
                'project_description'=> $request->description,
            ]);
            if ($files =$request->file('files')){
                foreach ($files as $file){
                    $fileName = $file->getClientOriginalName();
                    $file->move('upload\\'.$questionnaire->id, $fileName);
                    $questionnaire->files()->create([
                        'file'=>$fileName
                    ]);
                }

            }
        }
//        Notification::send($user,new SubmittedQuestionnaire($questionnaire));
        return response()->json(['success'=>'upload form successfully !!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =Auth::user();
        $questionnaire = Questionnaire::with('files')->find($id);
        $questionnaires = $user->questionnaires;
        $projects = $user->projects;
        return view('users.Questionnaires.show',compact(['questionnaire','questionnaires','user','projects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaire::find($id);
        foreach ($questionnaire->files as $file){
            $file_path = public_path('upload/'.$questionnaire->id."/".$file->file);
            if (File::exists($file_path)) File::delete($file_path);
            $file->delete();
        }
        $questionnaire->delete();
        return redirect(route('profiles.index'));
    }
}