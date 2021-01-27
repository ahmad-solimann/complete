<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectHistory;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        return redirect(route('admin.projects.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::where('parent_id',null)->with('categoryDetails')->get();
        $category= Category::where('parent_id',null)->with('categoryDetails')->first();
        return view('admin.projects.new',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project =$this->projectRepository->add($request);
        if(isset($project)){
            Session::flash('success', 'Project was added successfully!');
           return redirect(route('admin.projects.show',$project->id));
        }
        else
            return redirect(route('admin.projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('id',$id)->with('teamMembers')->first();
        $categoriesTree = $project->category->getParentTree();
        return view('admin.projects.show',compact('project','categoriesTree'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $categoriesTree = $project->category->getParentTree();
        $category= Category::where('parent_id',null)->with('categoryDetails')->first();
        return view('admin.projects.edit',compact('project','category','categoriesTree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = $this->projectRepository->update($request,$id);
        if(isset($project)){
            Session::flash('success', 'Project was updated successfully!');
            return redirect(route('admin.projects.send-info',$id));
        }
        return redirect(route('admin.projects.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        Session::flash('success','Project was deleted successfully!');
        return redirect(route('admin.projects.index'));
    }
    public function SendInfoAboutUpdates($id){
        $project = Project::find($id);
        return view('admin.projects.send-info',compact('project'));
    }

    public function StoreUpdates(Request $request, $id){
        $this->projectRepository->storeUpdatesInfo($request,$id);
        return redirect(route('admin.projects.show',$id));
    }

    public function moveProject(Request $request){
        $id=$request->get('project');
        $project = Project::find($id);
        try{
            MoveCurrentProjectToProjects($id);
        } catch (Exception $e){ }
        if(isset($project))
        $project->closeProject();
        return;
    }
    public function restoreProject(Request $request){
        $id=$request->get('project');
        $project = Project::find($id);
        try{
            MoveProjectToCurrentProjects($id);
        } catch (Exception $e){}

        if(isset($project))
        $project->restoreProject();
        return;
    }
    public function showProjectHistory ($id){
        $projectHistory = ProjectHistory::where('project_id',$id)->paginate(10);
        return view('admin.projects.history',compact('projectHistory'));
    }
}
