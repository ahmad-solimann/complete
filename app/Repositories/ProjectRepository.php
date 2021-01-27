<?php


namespace App\Repositories;



use App\Models\Project;
use App\Models\ProjectHistory;
use App\Models\TeamMember;
use App\Models\User;
use App\Notifications\ProjectUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectRepository
{
    function add(Request $request){
        $project= new Project($request->except(['username','main_category','team-members-names','team-members-titles']));
        if ($request->has('username')){
            $user = User::where('username',$request->get('username'))->first();
            if(!isset($user)){
                return;
            }
            $project->user_id= $user->id;
        }
        if (!$request->has('category_id')){
            $project->category_id = $request->get('main_category');
        }
        $project->save();
        if ($request->has('team-members-names')){
            $teamMemberTitles = $request->get('team-members-titles');
            $i=0;
            foreach ($request->get('team-members-names') as $teamMemberName){
                $teamMember = new TeamMember([
                    'project_id'=> $project->id,
                    'name' => $teamMemberName,
                    'title'=>$teamMemberTitles[$i]
                ]);
                $teamMember->save();
                $i++;
            }
        }
        $this->makeProjectDirectories($project->id);
        return $project;
    }

    public function update(Request $request ,$id){
        $project = Project::find($id);
        $project->update($request->except(['username','main_category','team-members-names','team-members-titles','team-members-changed']));
        if ($request->has('username')){
            $user = User::where('username',$request->get('username'))->first();
            if(!isset($user)){
                return;
            }
            $project->user_id= $user->id;
        }
        if (!$request->has('category_id')){
            if($request->has('main_category')) {
                $project->category_id = $request->get('main_category');
            }
        }
        $project->save();
        if ($request->get('team-members-changed')!== "0"){
            if($request->has('team-members-names')){
                $teamMemberNames= $request->get('team-members-names');
                $teamMemberTitles= $request->get('team-members-titles');
                $teamMemberIds= $request->get('team-members-ids');

                // delete deleted team members
                foreach ($project->teamMembers as $teamMember){
                    if(!in_array($teamMember->id, $teamMemberIds))
                    {
                        $teamMember->delete();
                    }

                }
                $i=0;
                foreach ($teamMemberNames as $name){
                    if ($teamMemberIds[$i]=="NEW"){
                        // create new team member
                        $teamMember = New TeamMember([
                            'name' => $name,
                            'title' =>$teamMemberTitles[$i],
                            'project_id'=> $project->id
                        ]);
                        $teamMember->save();
                    }
                    else{
                        //update current team member
                        $teamMember= TeamMember::find($teamMemberIds[$i])->first();
                        $teamMember->update([
                            'name' => $name,
                            'title' =>$teamMemberTitles[$i]
                        ]);
                        $teamMember->save();
                    }
                    $i++;
                }
            }
            else {
                // delete all team members
                foreach ($project->teamMembers as $teamMember){
                    $teamMember->delete();
                }
            }
        }
        return $project;

    }

    public function storeUpdatesInfo(Request $request,$id){
        $project = Project::find($id);
        if($request->get('msg-log')!=null){
            $msgLog= New ProjectHistory([
                'admin_id' => auth()->user()->id,
                'project_id'=> $id,
                'message_content' => $request->get('msg-log')
            ]);
            $msgLog->save();
        }
        if($request->get('email-to-user')!=null){
            $owner= $project->user;
            $emailContent=$request->get('email-to-user');
            $owner->notify(new ProjectUpdated($emailContent));
        }
    }

    public function makeProjectDirectories($id){
        $path='public\files\Admin Area\Current Projects\\'.$id;
        Storage::makeDirectory($path);
        Storage::makeDirectory($path.'/Record/Issued');
        Storage::makeDirectory($path.'/Record/Received');
        Storage::makeDirectory($path.'/Graphics');
        Storage::makeDirectory($path.'/Live/Mood & Feel');
        Storage::makeDirectory($path.'/Live/Specifications');
        Storage::makeDirectory($path.'/Live/Sketches');
        Storage::makeDirectory($path.'/Live/Site Photos');
        Storage::makeDirectory($path.'/Live/Schedules');
        Storage::makeDirectory($path.'/Live/Research');
        Storage::makeDirectory($path.'/Live/Presentations');
        Storage::makeDirectory($path.'/Live/ACAD');
        Storage::makeDirectory($path.'/Live/3D');
        Storage::makeDirectory($path.'/Admin/Supplier');
        Storage::makeDirectory($path.'/Admin/Contractor');
        Storage::makeDirectory($path.'/Admin/Authority');
        Storage::makeDirectory($path.'/Admin/Sub Consult');
        Storage::makeDirectory($path.'/Admin/Design');
        Storage::makeDirectory($path.'/Admin/Client');
        Storage::makeDirectory($path.'/Admin/Internal');
        Storage::makeDirectory($path.'/Admin/BIDS');
    }


}