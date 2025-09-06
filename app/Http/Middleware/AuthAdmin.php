<?php
namespace App\Http\Middleware;
use App\Modules\Permission\Models\Permission;
use App\Modules\AdminModules\Models\AdminModules;
use App\Modules\AccessRoles\Models\AccessRoles;
use App\Modules\User\Models\User;

use Closure;
Use Auth;
Use Redirect;
Use Route;
Use CustomHelper;
Use Config;
include app_path() . '/admin_routes.php';
class AuthAdmin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (Auth::guest()){
			return Redirect::route('login');
		}
		elseif(!in_array(Auth::user()->user_role_id, [SUPER_ADMIN_ROLE_ID, SUB_ADMIN_ROLE_ID, MEMBER_ROLE_ID])){
			return Redirect::route('login')->with('error', trans('Something went wrong!'));
		}
		 
		
        return $next($request);
    }
}
