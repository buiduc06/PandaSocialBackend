
<!DOCTYPE HTML>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>@yield('title', 'Mạng xã hội học tập panda')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />

	<!-- facebook -->
	<meta property='og:url' content='@yield('fb_link', url()->current())'>
	<meta property="og:video:width" content="640" />
	<meta property="og:video:height" content="360" />
	<meta property="og:video:type" content="mp4" />
	<meta property="og:image:width"      content="1366">
	<meta property="og:image:height"     content="768">
	<meta property="og:title" content="@yield('fb_title', '')">
	<meta property="og:type"          content="website" />
	<meta property="og:description" content="@yield('fb_description', '')">
	
	<!-- <meta property="og:description" content="Truyền hình Nhân Dân"> -->
	<meta property="og:image" content="@yield('fb_img', '')">
	<meta property="og:video" content="@yield('fb_video', '')">
	
	<!-- end facebook -->

<link rel="icon" type="image/png" sizes="16x16" href="/images/logo_2.png">

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
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<!-- //fonts -->
	<link href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
</head>
<body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<!-- <script src="../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script> -->
	<body>
		@include('customer.layouts.header')


		@include('customer.layouts.aside')
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="pjax-container">
			@yield('content')	
			<!---728x90--->
			@include('customer.layouts.footer')
			<div id="fb-root"></div>
    	<script>(function(d, s, id) {
    		var js, fjs = d.getElementsByTagName(s)[0];
    		if (d.getElementById(id)) return;
    		js = d.createElement(s); js.id = id;
    		js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=1545563538883800&autoLogAppEvents=1';
    		fjs.parentNode.insertBefore(js, fjs);
    	}(document, 'script', 'facebook-jssdk'));</script>
		</div>
		
		
		<div class="clearfix"> </div>
		<div class="drop-menu">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
				<li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
			</ul>
		</div>

		 <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap core JavaScript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="/assets/customer/js/bootstrap.min.js"></script>
    	<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    	<script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    	@if(Session()->has('msg'))
    	<script>
    		toastr.success("{{Session::get('msg')}}", 'Thành Công', {timeOut: 5000});
    	</script>
    	@endif

    	@if(Session()->has('msg_error'))
    	<script>
    		toastr.error("{{Session::get('msg_error')}}", 'Lỗi', {timeOut: 5000})
    	</script>
    	@endif

    	 
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    	<script>
    		$(document).ready(function(){
    			$(document).pjax('a', '#pjax-container')
    		});
    	</script>

    	@stack('js')
    </body>
    </html>