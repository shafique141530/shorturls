<?php

namespace App\Http\Controllers;

 
use App\Models\User;
use App\Models\Company;
use Auth, Request, Redirect, Validator, Hash, Config;


class UserController extends Controller
{
    /**
     * Display a listing of the sub users.
     */
    public function index()
    {
		
		Config::set('user_type', array(
			1 => 'Super Admin',
			2 => 'Sub Admin',
			3 => 'Member'
		));

 
 
 
		$loggedinUserId = Auth::user()->id;
        $users = User::with('company')->where('created_by', $loggedinUserId)->get();
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
		
		$validationDate =	array(
			'name'	=> $formData['name'],
			'email'	=> $formData['email'],
			'password'	=> $formData['password'],
			'confirm_password'	=> $formData['confirm_password']
		);
		
		$validationRules = array(
			'name'	=> 'required|max:50',
			'email' => 'required|email|unique:users,email',			
			'password' => 'required|regex:'.PASSWORD_REGX,
			'confirm_password' => 'required|same:password'				
		);
		
		$validationMessages = array(
			'name.required'	=> 'Please enter a name.',  	
			'name.max'	=> 'Name must be maximum 50 character long.',  	
			'email.required' =>  'Please enter email here.',
			'email.email' =>  'Please enter a valid email here.',
			'email.unique' =>  'This email is already exists, please enter another.',
			
			'password.required'	=>  'Please enter password here.',
            'password.regex' =>  'Password must have minimum 8 characters and should contain atleast 1 uppercase letter and 1 number and 1 special character.',
            'confirm_password.required' =>  'Please enter your password again here.',
            'confirm_password.same' =>  'Password and confirm password does not match.',
		);
		
		if($loggedinUserRoleId == SUPER_ADMIN_ROLE_ID ){
			$validationRules['company_name'] = 'required|max:50';
			
			$validationMessages['company_name.required'] = 'Please enter a company name.';
			$validationMessages['company_name.max'] = 'Name must be maximum 50 character long.';
			
			$validationDate['company_name'] = $formData['company_name'];
		}
		
		
		if($loggedinUserRoleId == SUB_ADMIN_ROLE_ID ){
			$validationRules['user_role_id'] = 'required';
			$validationMessages['user_role_id.required'] = 'Please select user role.';
			$validationDate['user_role_id'] = $formData['user_role_id'];
		}
		
		
		$validator = Validator::make(
			$validationDate,
			$validationRules,
			$validationMessages
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}
		else{
			
			
			
			if(in_array($loggedinUserRoleId, [SUB_ADMIN_ROLE_ID, MEMBER_ROLE_ID])){
				$companyId = Auth::user()->company_id;
			}
			else if(isset($formData['company_name']) && !empty($formData['company_name'])){
				$companyObject	= new Company;
				$companyObject->name = $formData['company_name'];
				$companyObject->save();
				
				$companyId = $companyObject->id; 
			}
			
			$password = $formData['password'];
			$model	= new User;
			$model->name = $formData['name'];
			$model->email = $formData['email'];
			$model->name = $formData['name'];
			$model->password = Hash::make($password);
			$model->user_role_id = ($loggedinUserRoleId == SUPER_ADMIN_ROLE_ID ) ? SUB_ADMIN_ROLE_ID : $formData['user_role_id'];
			$model->created_by = (Auth::check() && Auth::user()->id) ? Auth::user()->id : 0;
			$model->company_id = $companyId;
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
