@extends('layouts.login_layout')

@section('content')
<?php

if(!isset($_COOKIE['remember_admin'])) {
  $rememberdata = "";
}else{
   $value = $_COOKIE['remember_admin'];
   $rememberdata = json_decode($value);
}

$email_cookie 	 = Cookie::get('email');
$remember_cookie = Cookie::get('remember');
?>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form method="post" action="{{ route('login') }}">
							<div class="form-group">
								<label for="email">
									Email
								</label>
								{{ Form::text('email', (isset($rememberdata->email) && !empty($rememberdata->email) ? $rememberdata->email:''), ['placeholder' => 'Email *', 'class' => 'form-control ',"autofocus"])}}
							</div>
							<div class="form-group">
								<label for="password">
									Password
								</label>
								{{Form::password('password', ['placeholder' => 'Password *', 'class' => 'form-control'])}}
							</div>
							<button class="btn btn-danger waves-effect" type="submit">
								Login
							</button>
							@csrf
						</form>
						 
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

