@extends('customer.layouts.main')
@push('css')
<link href="https://vjs.zencdn.net/7.3.0/video-js.css" rel="stylesheet">
@endpush
@section('title', $course->title.' | Mạng xã hội học tập panda')
@section('fb_title', $course->title.' | Mạng xã hội học tập panda')
@section('fb_description', $course->description.' | Mạng xã hội học tập panda')
@section('fb_img', $course->getImg())
@section('fb_video', optional($course->video)->first()->getVideoS3())
@section('content')
@if(optional($course->video)->count() < 0)
<h5>Khóa học không có video nào</h5>
@else
<div class="show-top-grids">
	@foreach ($video_first as $key => $video)
	@if($key == 0)
	<div class="col-sm-8 single-left">
		<div class="song">
			<div class="song-info">
				<h3>{{$video->title}}</h3>	
			</div>
			<div class="video-grid">
				<iframe src="{{$video->getVideoS3()}}" allowfullscreen autoplay="off"></iframe>

			</div>
		</div>

		<div class="clearfix"> </div>
		<div class="published">

		 
			{{-- {{dd($course->description)}} --}}
			<div class="load_more">	
				<ul id="myList">
			 
						<h4>Xuất bản vào {{$course->getDatePublic()}}</h4>
						<p>{{$course->description}}</p>
				 
					<div class="fb-share-button float-right" data-href="{{$course->getLinkCourse()}}" data-layout="button_count" data-size="small" data-mobile-iframe="true">
						<a target="_blank" href="{{$course->getLinkCourse()}}" class="fb-xfbml-parse-ignore"></a></div>


						 
					 

					</ul>
				</div>
			</div>
			{{-- {{dd($course->commentVideos)}} --}}
			<div class="all-comments">
				<div class="all-comments-info">
					<a href="#">Tất cả bình luận ({{$course->getCountComment()}})</a>
					<div class="box">
						<form method="POST" action="{{route('customer.postComment')}}">
							<textarea placeholder="Nội dung bình luận" name="content" required=" "></textarea>
							<input type="submit" value="Bình luận">
							<div class="clearfix"> </div>
							<input type="hidden" name="course_id" value="{{$course->id}}">
						</form>
					</div>
				</div>
				<div class="media-grids">
					@foreach($course->commentVideos as $item)
					<div class="media">
						<h5>{{optional($item->user)->name}}</h5>
						<div class="media-left">
							<a href="#" style="background: url({{$item->user->getAvatar()}}) center no-repeat ;background-size: cover;">

							</a>
						</div>
						<div class="media-body">
							<p>{{$item->content}}</p>
							<span>{{$item->created_at->format('d-m-Y H:s')}}</span>
						</div>
					</div>

					@endforeach
				</div>
			</div>
		</div>
		@endif 
		@endforeach
		<div class="col-md-4 single-right">
			<h3>Up Next</h3>
			<div class="single-grid-right">
				@foreach ($course->video->where('id', '!=', $video_first[0]->id) as $key => $video)

			 
				<div class="single-right-grids">
					<div class="col-md-4 single-right-grid-left">
						<a href="{{$video->getLinkVideo()}}">
							<img src="{{$video->image ? $video->getThumbVideo() : $course->getImg()}}" alt="" />
						</a>
					</div>
					<div class="col-md-8 single-right-grid-right">
						<a href="{{$video->getLinkVideo()}}" class="title">{{$video->title}}</a>
						<p class="author"><a href="javascript:;" class="author">{{optional($video->adminUser)->name}}</a></p>
						{{-- 						<p class="views">0 views</p> --}}
					</div>
					<div class="clearfix"> </div>
				</div>
		 
				@endforeach

			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	@endif
	@endsection

	@push('js')
	<script src="https://vjs.zencdn.net/7.3.0/video.js"></script>
	<script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
	@endpush