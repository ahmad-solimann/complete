<?php


namespace App\Repositories;


use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{

    public function add(Request $request){
        //validation request
        $validated = $request->validate([
            'username' => 'required|unique:users|min:3|max:191',
            'email' => 'required|email|unique:users|min:3|max:191',
            'password' =>'required|min:6|max:20',
            'phone' => 'nullable|numeric|min:3'
        ]);
        //
        $user = new User($request->except('verified'));
        if ($request->has('password'))
            $user->password = bcrypt($request->get('password'));
        if ($request->has('verified'))
            $user->verified = 1;

        $user->save();
    }

    public function update (Request $request,User $user){
        $user->update($request->except(['verified','password']));
        if ($request->has('password'))
            $user->password = bcrypt($request->get('password'));
        if (($request->has('verified')) && (!$user->verified))
            $user->verified = 1;
        else if ((!$request->has('verified')) && ($user->verified))
            $user->verified = 0;

        $user->save();

    }

    public function delete (User $user){
        $notifications = Notification::where('data',$user->id)
            ->orWhere('data->userId',$user->id)
            ->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $user->delete();
    }

}