
<!DOCTYPE HTML>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>My Play a Entertainment Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap -->
	<link href="/assets/customer/css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
	<!-- //bootstrap -->
	<link href="/assets/customer/css/dashboard.css" rel="stylesheet">
	<!-- Custom Theme files -->
	<link href="/assets/customer/css/style.css" rel='stylesheet' type='text/css' media="all" />
	<script src="/assets/customer/js/jquery-1.11.1.min.js"></script>
	<!--start-smoth-scrolling-->
	<!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<!-- //fonts -->
</head>
<body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<!-- <script src="../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script> -->
	<body>
		@include('customer.layouts.header')


		@include('customer.layouts.aside')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			@yield('content')	
			<!---728x90--->
			@include('customer.layouts.footer')
		</div>
		
		
		<div class="clearfix"> </div>
		<div class="drop-menu">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
				<li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
			</ul>
		</div>
    <!-- Bootstrap core JavaScript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="/assets/customer/js/bootstrap.min.js"></script>
    	<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    </body>
    </html>