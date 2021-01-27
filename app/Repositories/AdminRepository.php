<?php


namespace App\Repositories;


use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRepository
{
    public function add(Request $request){
        //validation request
        $validated = $request->validate([
            'username' => 'required|unique:users|min:3|max:191',
            'email' => 'required|email|unique:users|min:3|max:191',
            'password' =>'required|min:6|max:20'
        ]);
        //
        $admin = new User($request->except('verified'));
        if ($request->has('password'))
            $admin->password = bcrypt($request->get('password'));

        $admin->verified = 1;
        $admin->user_role = User::ADMIN_ROLE;
        $admin->save();
    }
    public function update (Request $request,User $admin){
        //validation request
        $validated = $request->validate([
            'username' => 'nullable|min:3|max:191|unique:users,username,'.$admin->id,
            'email' => 'nullable|min:3|max:191|email|unique:users,email,'.$admin->id,
            'password' =>'nullable|min:6|max:20,'
        ]);
        //
        $admin->update($request->except(['verified','password']));
        if ($request->has('password'))
            $admin->password = bcrypt($request->get('password'));
        $admin->save();
    }

    public function delete (User $admin){
        $notifications = Notification::where('notifiable_id',$admin->id)->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $admin->delete();
    }



}