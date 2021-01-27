<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegisteredUser;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    public function dashboard(){
        if ($this->authorizeForUser(auth()->user(),'show-dashboard'))
        {
            $notifications= auth()->user()->unreadNotifications()->latest()->take(5);
            return view('admin.dashboard',compact('notifications'));
        }
        return redirect(route('users.home'))->with('error','You can\'t access to Admin Area');
    }
    public function index (){
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
            $admins = User::where('user_role', User::ADMIN_ROLE)->get();
            return view('admin.admins.index', compact('admins'));
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');


    }
    public function verifyUser(Request $request){
        $user = User::find($request->get('user'));
        $user->verify();
        return response()->json([]);
    }

    public function create (){
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
        return view('admin.admins.new');
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');
    }
    public function store(Request $request){
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
        $this->adminRepository->add($request);
        Session::flash('success', 'Admin was added successfully!');
        return redirect(route('admin.admins.index'));
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');
    }

    public function edit ($id){
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
        $admin = User::find($id);
        return view('admin.admins.edit',compact('admin'));
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');

    }

    public function update(Request $request, $id){
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
        $admin = User::find($id);
        $this->adminRepository->update($request,$admin);
        Session::flash('success', 'Admin was updated successfully!');
        return redirect(route('admin.admins.index'));
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');
    }

    public function destroy($id)
    {
        if ($this->authorizeForUser(auth()->user(),'isSuperAdmin')) {
        $admin = User::find($id);
        $this->adminRepository->delete($admin);
        Session::flash('success', 'Admin was deleted successfully!');
        return redirect(route('admin.admins.index'));
        }
        return redirect(route('admin.dashboard'))->with('error','You can\'t access to Admin Managing Area');
    }


}
