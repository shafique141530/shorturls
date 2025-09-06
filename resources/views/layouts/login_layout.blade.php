<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Site title goes here</title>
        
		 
		
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        
	  
		<link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

	   
    </head>
 	<script>
			// for close the message 
			$(document).ready(function(){
				$("#closemsg").click(function(){
					$(".alert").hide();
				})
			});
		</script>
	</head>
	 <body>
	 	<div class="login-page">
			<div class="login-box">
				<div class="body login-body">
					@if(Session::has('flash_notice'))

					<div class="alert alert-warning">
						<a href="javascript:void(0);" id="closemsg" class="close pull-right">x</a>
						{{ Session::get('flash_notice') }}
					</div>
					@endif
					
					@if(Session::has('error'))
					<div class="alert alert-danger">
						<a href="javascript:void(0);" class="close pull-right" id="closemsg" >x</a>
						<strong></strong> 	{{ Session::get('error') }}
					</div>	
					@endif
					
					@if(Session::has('success'))
					<div class="alert alert-success">
						<a href="javascript:void(0);" id="closemsg" class="close pull-right">x</a>
						{{ Session::get('success') }}
					</div>
					
					@endif
					@yield('content')
				</div>
			</div>
		</div>
	</body>
</html>

