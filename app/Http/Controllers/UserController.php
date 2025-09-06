<?php

namespace App\Http\Controllers;

 
use App\Models\User;
use Auth, Request, Redirect, Validator, Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the sub users.
     */
    public function index()
    {
		$loggedinUserId = Auth::user()->id;
        $users = User::where('created_by', $loggedinUserId)->get();
		return view('user.index', compact('users'));
    }
	
	
	public function create()
	{
		return view('user.create');
	}
	
	
	
	public function store(Request $request)
    {
		$loggedinUserRoleId = Auth::user()->user_role_id;
        $formData  = Request::all();
		$validator = Validator::make(
			array(
				'name'	=> $formData['name'],
				'email'	=> $formData['email']
			),
			array(
				'name'	=> 'required|max:50',
				'email' => 'required|email|unique:users,email'				
			),
			array(
				'name.required'	=> 'Please enter a name.',  	
				'name.max'	=> 'Name must be 50 character long.',  	
				'email.required' =>  'Please enter email here.',
				'email.email' =>  'Please enter a valid email here.',
				'email.unique' =>  'This email is already exists, please enter another.',
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}
		else{
			$password = 123456; 
			$model	= new User;
			$model->name = $formData['name'];
			$model->email = $formData['email'];
			$model->name = $formData['name'];
			$model->password = Hash::make($password);
			$model->user_role_id = ($loggedinUserRoleId == SUPER_ADMIN_ROLE_ID ) ? SUB_ADMIN_ROLE_ID : MEMBER_ROLE_ID;
			$model->created_by = (Auth::check() && Auth::user()->id) ? Auth::user()->id : 0;
			$model->save();
			
			if($loggedinUserRoleId == SUPER_ADMIN_ROLE_ID){
				$message = 'Sub-Admin created successfully.';
			}
			else {
				$message = 'Member created successfully.';
			}
			
			return redirect()->route('users.index')->with('success', $message);
		}
    }
	
	
	
	 
	
}
