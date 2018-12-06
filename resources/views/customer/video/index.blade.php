@extends('customer.layouts.main')
@push('css')
<link href="https://vjs.zencdn.net/7.3.0/video-js.css" rel="stylesheet">
@endpush
@section('content')
@if(optional($courses->video)->count() < 0)
<h5>Khóa học không có video nào</h5>
@else
<div class="show-top-grids">
	@foreach ($courses->video as $key => $video)
	@if($key == 0)
	<div class="col-sm-8 single-left">
		<div class="song">
			<div class="song-info">
				<h3>{{$video->title}}</h3>	
			</div>
			<div class="video-grid">
				<iframe src="{{$video->getVideoS3()}}" allowfullscreen ></iframe>
				 
				 
				</div>
			</div>
			<div class="song-grid-right">
				<div class="share">
					<h5>Share this</h5>
					<ul>
						<li><a href="#" class="icon fb-icon">Facebook</a></li>
						<li><a href="#" class="icon dribbble-icon">Dribbble</a></li>
						<li><a href="#" class="icon twitter-icon">Twitter</a></li>
						<li><a href="#" class="icon pinterest-icon">Pinterest</a></li>
						<li><a href="#" class="icon whatsapp-icon">Whatsapp</a></li>
						<li><a href="#" class="icon like">Like</a></li>
						<li><a href="#" class="icon comment-icon">Comments</a></li>
						<li class="view">200 Views</li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
			<div class="published">
				<script src="jquery.min.html"></script>
				<script>
					$(document).ready(function () {
						size_li = $("#myList li").size();
						x=1;
						$('#myList li:lt('+x+')').show();
						$('#loadMore').click(function () {
							x= (x+1 <= size_li) ? x+1 : size_li;
							$('#myList li:lt('+x+')').show();
						});
						$('#showLess').click(function () {
							x=(x-1<0) ? 1 : x-1;
							$('#myList li').not(':lt('+x+')').hide();
						});
					});
				</script>
				<div class="load_more">	
					<ul id="myList">
						<li>
							<h4>Published on 15 June 2015</h4>
							<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
						</li>
						<li>
							<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
							<p>Nullam fringilla sagittis tortor ut rhoncus. Nam vel ultricies erat, vel sodales leo. Maecenas pellentesque, est suscipit laoreet tincidunt, ipsum tortor vestibulum leo, ac dignissim diam velit id tellus. Morbi luctus velit quis semper egestas. Nam condimentum sem eget ex iaculis bibendum. Nam tortor felis, commodo faucibus sollicitudin ac, luctus a turpis. Donec congue pretium nisl, sed fringilla tellus tempus in.</p>
							<div class="load-grids">
								<div class="load-grid">
									<p>Category</p>
								</div>
								<div class="load-grid">
									<a href="movies.html">Entertainment</a>
								</div>
								<div class="clearfix"> </div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="all-comments">
				<div class="all-comments-info">
					<a href="#">All Comments (8,657)</a>
					<div class="box">
						<form>
							<input type="text" placeholder="Name" required=" ">			           					   
							<input type="text" placeholder="Email" required=" ">
							<input type="text" placeholder="Phone" required=" ">
							<textarea placeholder="Message" required=" "></textarea>
							<input type="submit" value="SEND">
							<div class="clearfix"> </div>
						</form>
					</div>
					<div class="all-comments-buttons">
						<ul>
							<li><a href="#" class="top">Top Comments</a></li>
							<li><a href="#" class="top newest">Newest First</a></li>
							<li><a href="#" class="top my-comment">My Comments</a></li>
						</ul>
					</div>
				</div>
				<div class="media-grids">
					<div class="media">
						<h5>Tom Brown</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Mark Johnson</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Steven Smith</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Marry Johne</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Mark Johnson</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Mark Johnson</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
					<div class="media">
						<h5>Peter Johnson</h5>
						<div class="media-left">
							<a href="#">

							</a>
						</div>
						<div class="media-body">
							<p>Maecenas ultricies rhoncus tincidunt maecenas imperdiet ipsum id ex pretium hendrerit maecenas imperdiet ipsum id ex pretium hendrerit</p>
							<span>View all posts by :<a href="#"> Admin </a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif 
		@endforeach
		<div class="col-md-4 single-right">
			<h3>Up Next</h3>
			<div class="single-grid-right">
				@foreach ($courses->video as $key => $video)
				@if($key >= 1)
				<div class="single-right-grids">
					<div class="col-md-4 single-right-grid-left">
						<a href="single.html"><img src="{{$video->getVideoS3()}}" alt="" /></a>
					</div>
					<div class="col-md-8 single-right-grid-right">
						<a href="single.html" class="title">{{$video->title}}</a>
						<p class="author"><a href="#" class="author">{{optional($video->adminUser)->name}}</a></p>
						<p class="views">0 views</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				@endif
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