@extends('layouts.default')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('shorturl.index') }}>Create Shorturls</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('shorturl.create') }}>Add Shorturl</a>
                </div>
            </div>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a Long URL</h3>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
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
					
					
					
                    
                    <br>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
	
@stop