<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationsController extends Controller
{
    public function count() {
        return response()->json([
            'count' => auth()->user()->notificationsCount()
        ]);
    }
    public function get(Request $request){
        $user = User::find($request->get('user'));
        $notifications=$user->unreadNotifications()->latest()->take(8)->get();
        return response()->json([
            'notifications' => $notifications
        ]);
    }
    public function all(){
        $notificationsAll = auth()->user()->notifications()->latest()->paginate(10);
        return view('admin.notifications.index',compact('notificationsAll'));
    }
    public function markAsRead(Request $request){
        $id = $request->get('notification');
        $notification =auth()->user()->notifications()
            ->where('id', $id)
            ->get()
            ->first();
        $notification->markAsRead();
        $notification->save();
        return response()->json([]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($id){
        auth()->user()->notifications()
            ->where('id', $id)
            ->get()
            ->first()
            ->delete();
        Session::flash('success', 'Notification was removed');
        return redirect(route('admin.notifications-all'));
    }

}
