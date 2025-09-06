@extends('layouts.default')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('shorturl.index') }}>Shorturls</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('shorturl.create') }}>Add Shorturl</a>    
                </div>
            </div>
    </nav>
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Update Shorturl</h3>
                <form action="{{ route('shorturl.update', $shorturl->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    
					<div class="form-group">
                        <label for="title">Long URL</label>
                        {{ Form::text('long_url', $shorturl->long_url, ['placeholder' => 'Long URL *', 'class' => 'form-control'])}} 
						
						 
                    </div>
					<span id="long_url_error" class="error text-danger"><?php echo  $errors->first('long_url')  ; ?></span>
					 
                    <button type="submit" class="btn btn-primary">Update Post</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
	
@stop