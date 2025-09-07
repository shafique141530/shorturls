@extends('layouts.default')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="javascript:void(0)">Add User</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('users.index') }}>User List</a>
                </div>
            </div>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a User</h3>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
					
					@if(Auth::user()->user_role_id ==  SUPER_ADMIN_ROLE_ID)
						<div class="form-group">
							<label for="title">Company Name</label>
							{{ Form::text('company_name', '', ['placeholder' => 'Company Name *', 'class' => 'form-control'])}} 
						</div>
						<span id="company_name_error" class="error text-danger"><?php echo  $errors->first('company_name')  ; ?></span>
					@endif
					
					
					@if(Auth::user()->user_role_id ==  SUB_ADMIN_ROLE_ID)
						<div class="form-group">
							<label for="user_role_id">User Type</label>
							{{ Form::select('user_role_id', 
								[
									SUB_ADMIN_ROLE_ID => 'Sub Admin',
									MEMBER_ROLE_ID => 'Member'
								], 
								null, 
								['placeholder' => 'Select User Type', 'class' => 'form-control']) 
							}}
						</div>
						<span id="user_role_id_error" class="error text-danger">
							{{ $errors->first('user_role_id') }}
						</span>
					@endif
					
					
					
					<div class="form-group">
                        <label for="title">Name</label>
						{{ Form::text('name', '', ['placeholder' => 'Name *', 'class' => 'form-control'])}} 
                    </div>
					<span id="name_error" class="error text-danger"><?php echo  $errors->first('name')  ; ?></span>
					
					
					<div class="form-group">
                        <label for="title">Email</label>
						{{ Form::text('email', '', ['placeholder' => 'Email *', 'class' => 'form-control'])}} 
                    </div>
					<span id="email_error" class="error text-danger"><?php echo  $errors->first('email')  ; ?></span>
					
					
					<div class="form-group">
                        <label for="title">Password</label>
						{{ Form::password('password',  ['placeholder' => 'Password *', 'class' => 'form-control'])}} 
                    </div>
					<span id="password_error" class="error text-danger"><?php echo  $errors->first('password')  ; ?></span>
					
					<div class="form-group">
                        <label for="title">Confirm Password</label>
						{{ Form::password('confirm_password',    ['placeholder' => 'Confirm Password *', 'class' => 'form-control'])}} 
                    </div>
					<span id="confirm_password_error" class="error text-danger"><?php echo  $errors->first('confirm_password')  ; ?></span>
                    
                    <br>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
	
@stop