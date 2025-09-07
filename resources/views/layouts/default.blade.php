<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="robots" content="noindex, nofollow">
 
		<title></title>

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
		<meta name="keywords" content=""/>
		<meta name="description" content=""/>
		
		<link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

	</head>
	<body class="theme-orange ls-closed">
 
		 <!-- User Info -->
		<div class="user-info">
			<div class="info-container">
				<div class="name">{{ Auth::user()->name}}</div>
				<div class="email">{{ Auth::user()->email}}</div>
				
				<div class="container mt-4">
					<div class="row">
						<div class="col-md-4">
							<a href="{{route('shorturl.index')}}">Short URLs </a>
						</div>
						
						@if(Auth::user()->user_role_id ==  SUB_ADMIN_ROLE_ID)
							<div class="col-md-4">
								<a href="{{route('users.index')}}"> Members </a>
							</div>
						@elseif(in_array(Auth::user()->user_role_id, [SUPER_ADMIN_ROLE_ID, SUB_ADMIN_ROLE_ID]))
							<div class="col-md-4">
								<a href="{{route('users.index')}}">Sub Admins </a>
							</div>
						@endif
						
						<div class="col-md-4">
							<a href="{{route('logout')}}">Logout </a>
						</div>
					</div>
				</div>
			</div>
				<!-- #User Info -->

		<!-- Main Container Start -->
		<section class="content">
			<div class="container-fluid">
				<div class="flash-msg">
					@if(Session::has('error'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('error') }}
					</div>
					@endif
					@if(Session::has('success'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('success') }}
					</div>
					@endif
					@if(Session::has('flash_notice'))
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('flash_notice') }}
					</div>
					{{Session::forget('apartment_added')}}
					@endif
				</div>
				@yield('content')
			</div>
		</section>

	</body>
</html>
