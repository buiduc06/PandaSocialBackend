@extends('customer.layouts.main')
@section('title', 'Trang chủ | Mạng xã hội học tập panda')
@section('content')


<div class="main-grids">
	<div class="top-grids">
		<div class="recommended-info">
			<h3>Khóa học mới</h3>
		</div>
		@foreach($recent_videos as $course)
		<div class="col-md-4 resent-grid recommended-grid">
			<div class="resent-grid-img recommended-grid-img">
				<a href="{{$course->getLinkCourse()}}"><img src="{{$course->getImg()}}" alt=""></a>
				<div class="time small-time">
					<p>{{rand(10,999)}}</p>
				</div>
				<div class="clck small-clck">
					<span class="glyphicon glyphicon-eye-open" style="color:white" aria-hidden="true"></span>
				</div>
			</div>
			<div class="resent-grid-info recommended-grid-info video-info-grid">
				<h5><a href="{{$course->getLinkCourse()}}" class="title">{{str_limit($course->title, $limit = 100, $end = '...')}}</a></h5>
				<ul>
					<li><p class="author author-info"><a href="#" class="author">{{$course->adminUser->name}}</a></p></li>
					<li class="right-list"><p class="views views-info">{{count($course->coursevideo)}} video</p></li>
				</ul>
			</div>
		</div>
		@endforeach
		<div class="clearfix"> </div>
	</div>
	@foreach($categories as $category)


	<div class="recommended">
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3>{{$category->name}}</h3>
			</div>
			@foreach($category->course as $course)
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="{{$course->getLinkCourse()}}"><img src="{{$course->getImg()}}" alt=""></a>
					<div class="time small-time">
						<p>{{rand(10,999)}}</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-eye-open" style="color:white" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="{{$course->getLinkCourse()}}" class="title">{{str_limit($course->title, $limit = 100, $end = '...')}}</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">{{$course->adminUser->name}}</a></p></li>
						<li class="right-list"><p class="views views-info">{{count($course->coursevideo)}} video</p></li>
					</ul>
				</div>
			</div>

			@endforeach
			<div class="clearfix"> </div>
		</div>

	</div>
	@endforeach
</div>

@endsection