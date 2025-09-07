<?php

namespace App\Http\Controllers;

 
use App\Models\Shorturl;
use App\Models\User;
use Auth, Request, Redirect, Validator, DB;

class ShorturlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$loogedInUserId = Auth::user()->id;
		
		$shorturlsQuery = Shorturl::query();
		
        if(Auth::user()->user_role_id == MEMBER_ROLE_ID){
			$shorturlsQuery->where('created_by', $loogedInUserId);
		}
		else if(Auth::user()->user_role_id == SUB_ADMIN_ROLE_ID){
			
			$memberIds		=	User::where('created_by', $loogedInUserId)->pluck('id');
			$memberIds[] 	= 	$loogedInUserId;  
			
			$shorturlsQuery->whereIn('created_by', $memberIds);
		}
		
		$shorturls = $shorturlsQuery->with(['user', 'company'])->get();
		return view('shorturls.index', compact('shorturls'));
    }
	
	public function create()
	{
		return view('shorturls.create');
	}
	
	 
	public function store(Request $request)
    {
        $formData  = Request::all();
		$validator = Validator::make(
			array(
				'long_url'	=> $formData['long_url']
			),
			array(
				'long_url'	=> 'required|url:http,https',
			),
			array(
				'long_url.required'	=> 'Please enter a long URL',  	
				'long_url.url' =>  'Please enter a valid long URL',
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}
		else{
			
			$companyId = Auth::user()->company_id;
			
			$model	= new Shorturl;
			$model->long_url = isset($formData['long_url']) ? $formData['long_url'] : null;
			$model->created_by = (Auth::check() && Auth::user()->id) ? Auth::user()->id : 0;
			$model->company_id = $companyId;
			$model->save();
			
			return redirect()->route('shorturl.index')->with('success','Shorturl created successfully.');
		}
    }
	
	 
	public function edit($id)
	{
		$shorturl = $this->getShorturlByAuth($id);
		 
		if (!empty($shorturl)) {	
			return view('shorturls.edit', compact('shorturl'));
		}
		else {
			return redirect()->route('shorturl.index');
		}
	}

     
    public function update(Request $request, string $id)
    {
		$formData  = Request::all();
		$validator = Validator::make(
			array(
				'long_url'	=> $formData['long_url']
			),
			array(
				'long_url'	=> 'required|url:http,https',
			),
			array(
				'long_url.required'	=> 'Please enter a long URL',  	
				'long_url.url' =>  'Please enter a valid long URL',
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}
		else{
			$model	=	$this->getShorturlByAuth($id);
			$model->long_url = isset($formData['long_url']) ? $formData['long_url'] : null;
			 
			$model->save();
			
			return redirect()->route('shorturl.index')->with('success','Shorturl updated successfully.');
		}
		 
    }
	
	
	
	private function getShorturlByAuth($id){
		$loogedInUserId = Auth::user()->id;
		$shorturlsQuery = Shorturl::where('id', $id);
		 
		if(Auth::user()->user_role_id == MEMBER_ROLE_ID){
			$shorturlsQuery->where('created_by', $loogedInUserId);
		}
		else if(Auth::user()->user_role_id == SUB_ADMIN_ROLE_ID){
			
			$memberIds		=	User::where('created_by', $loogedInUserId)->pluck('id');
			$memberIds[] 	= 	$loogedInUserId;  
			$shorturlsQuery->whereIn('created_by', $memberIds);
		}
		
		$shorturl = $shorturlsQuery->first();
		return $shorturl;
	}
	
	
	
	
	public function hit($encodedid)
	{
		$id = base64_decode($encodedid);
		$shorturl = Shorturl::find($id);
		if (!empty($shorturl)) {	
			$shorturl->views++;
			$shorturl->save();
			return Redirect::to($shorturl->long_url);
		}
		else {
			return redirect()->route('shorturl.index');
		}
	}

     
}
