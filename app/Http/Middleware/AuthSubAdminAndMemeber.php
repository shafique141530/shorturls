<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth, Redirect;

class AuthSubAdminAndMemeber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest()){
			return Redirect::route('login');
		}
		elseif(!in_array(Auth::user()->user_role_id, [SUB_ADMIN_ROLE_ID, MEMBER_ROLE_ID])){
			return Redirect::route('login')->with('error', trans('Something went wrong!'));
		}
		
		return $next($request);
    }
}
