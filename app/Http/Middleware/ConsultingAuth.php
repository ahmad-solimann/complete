<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultingAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)

    {

        if (auth()->user()){
            return $next($request);
        }
        if((isset($_COOKIE['id'])) && (isset($_COOKIE['email'])))
        {
            $id= $_COOKIE['id'];
            $email= $_COOKIE['email'];
            $user = User::find($id);
            try {
                if((isset($user)) && ($user->email==$email))
                {
                    Auth::login($user);
                }

            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }
        return $next($request);
    }
}
