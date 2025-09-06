<?php
namespace App\Http\Controllers;


use App\Modules\User\Models\User;
use Auth, Config, Cookie, Hash, Redirect, Session, View, Validator, Request;

/**
 * Login Controller
 *
 * Add your methods in the class below
 *
 * This file will render views\login
 */
class LoginController extends Controller {


	public function __construct() {
		// echo time();die;
	}


	/**
	 * Function for display  login page
	 *
	 * @param null
	 *
	 * @return view page.
	 */
	public function login(Request $request){
		if(Auth::check()){
			if((Auth::user()->user_role_id == SUPER_ADMIN_ROLE_ID) || (Auth::user()->user_role_id == SUB_ADMIN_ROLE_ID)){
				return Redirect:: route('users.index');
			}
			else {
				return Redirect:: route('shorturl.index');
			}
		}
		if(Request::isMethod('post')){
			$userdata = array(
				'email' 			=> Request::get('email'),
				'password' 			=> Request::get('password'),
			);

			$remember 	= 	(!empty(Request::get('remember'))) ? true : false;
			if (Auth::attempt($userdata)){

				Session::flash('success',trans("Login Successfully."));
				return Redirect:: route('shorturl.index');
			}
			else{
				Session::flash('error',trans("Please enter valid email address or password."));
				return Redirect::back() ->withInput();
			}
		}
		else{
			return View::make('Login.index');
		}
	}// end index()


	/**
	 * Function for logout users
	 *
	 * @param null
	 *
	 * @return rerirect page.
	*/
	public function logout(Request $request){
		if(Auth::check()){
			Session::flash('success',trans("Logout Successfully..."));
			Auth::logout();
			return Redirect::route('login');
		}
	}
}
