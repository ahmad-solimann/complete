<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ProjectHistory;
use App\Models\Questionnaire;
use App\Repositories\QuestionnaireRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class QuestionnaireController extends Controller
{
    /**
     * @var QuestionnaireRepository
     */
    private $questionnaireRepository;

    /**
     * QuestionnaireController constructor.
     * @param QuestionnaireRepository $questionnaireRepository
     */
    public function __construct(QuestionnaireRepository $questionnaireRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questionnaires= Questionnaire::latest()->paginate(10);
        return view('admin.questionnaires.index',compact('questionnaires'));
    }


    /**
     * Display the specified resource.
     *
     * @param Questionnaire $questionnaire
     * @return Response
     */
    public function show(Questionnaire $questionnaire)
    {
        $categoriesTree = $questionnaire->category->getParentTree();
        return view('admin.questionnaires.show',compact('questionnaire','categoriesTree'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Questionnaire $questionnaire
     * @return Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        $notifications = Notification::where('data->QuestionnaireId',$questionnaire->id)->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $this->questionnaireRepository->delete($questionnaire);
        Session::flash('success', 'Questionnaire was deleted successfully!');
       return redirect()->route('admin.questionnaires.index');
    }
}
