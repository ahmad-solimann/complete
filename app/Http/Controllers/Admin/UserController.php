<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         $users = User::where('user_role',User::USER_ROLE)->latest()->paginate(10);
         return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->userRepository->add($request);
        Session::flash('success', 'User was Added successfully!');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->userRepository->update($request,$user);
        Session::flash('success', 'User was updated successfully!');
        return redirect(route('admin.users.show',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $notifications = Notification::where('data->userId',$id)->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $this->userRepository->delete($user);
        Session::flash('success', 'User was deleted successfully!');
        return redirect(route('admin.users.index'));
    }

    public function getUsernameAutocomplete(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = User::where('user_role',User::USER_ROLE)->where('username', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu col-12" style="display:block; position:relative;">';
            if (sizeof($data)>0){
                foreach($data as $row)
                {
                    if ($query== $row->username) return;
                    $output .= '
       <li class="pr-1 pl-2 pb-1 auto-comp-li"><a class="text-dark text-small">'.$row->username.'</a></li>
       ';
                }
            }
            else {
                $output .= '
       <li class="pr-1 pl-2 pb-1 text-small text-gray">'.__('No users were found').'</li>
       ';

            }

            $output .= '</ul>';
            echo $output;
        }
    }
}
