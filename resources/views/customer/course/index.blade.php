@extends('customer.layouts.main')
@section('content')


<div class="main-grids">
	<div class="top-grids">
		<div class="recommended-info">
			<h3>Khóa học mới</h3>
		</div>
		@foreach($recent_videos as $course)
		<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
			<div class="resent-grid-img recommended-grid-img">
				<a href="{{$course->getLinkCourse()}}"><img src="/assets/customer/images/t1.jpg" alt="" /></a>
				<div class="time">
					<p>3:04</p>
				</div>
				<div class="clck">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
				</div>
			</div>
			<div class="resent-grid-info recommended-grid-info">
				<h3><a href="{{$course->getLinkCourse()}}" class="title title-info">{{str_limit($course->title, $limit = 100, $end = '...')}}</a></h3>
				<ul>
					<li><p class="author author-info"><a href="#" class="author">{{$course->adminUser->name}}</a></p></li>
					<li class="right-list"><p class="views views-info">0 views</p></li>
				</ul>
			</div>
		</div>
		 @endforeach
		<div class="clearfix"> </div>
	</div>
	<div class="recommended">
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3>Animated Cartoon</h3>
			</div>
			<script src="/assets/customer/js/responsiveslides.min.js"></script>
			<script>
				$(function () {
					$("#slider3").responsiveSlides({
						auto: true,
						pager: false,
						nav: true,
						speed: 500,
						namespace: "callbacks",
						before: function () {
							$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
						}
					});

				});
			</script>
			<div  id="top" class="callbacks_container">
				<ul class="rslides" id="slider3">
					<li>
						<div class="animated-grids">
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>7:34</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c1.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>6:23</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus varius viverra nullam sit amet viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">14,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c2.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>2:45</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c3.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>4:34</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</li>
					<li>
						<div class="animated-grids">
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c1.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>4:42</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed viverra viverra nullam nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c2.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>6:14</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c3.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>2:34</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">varius sit sed viverra viverra nullam Nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>5:12</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">1,14,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</li>
					<li>
						<div class="animated-grids">
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c2.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>4:42</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed viverra viverra nullam nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c3.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>6:14</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>2:34</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">varius sit sed viverra viverra nullam Nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c3.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>5:12</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">1,14,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</li>
					<li>
						<div class="animated-grids">
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c3.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>4:42</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed viverra viverra nullam nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>6:14</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c1.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>2:34</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">varius sit sed viverra viverra nullam Nullam interdum metus</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">2,114,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="col-md-3 resent-grid recommended-grid slider-first">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><img src="/assets/customer/images/c2.jpg" alt="" /></a>
									<div class="time small-time slider-time">
										<p>5:12</p>
									</div>
									<div class="clck small-clck">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
									<div class="slid-bottom-grids">
										<div class="slid-bottom-grid">
											<p class="author author-info"><a href="#" class="author">John Maniya</a></p>
										</div>
										<div class="slid-bottom-grid slid-bottom-right">
											<p class="views views-info">1,14,200 views</p>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="recommended">
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3>Recommended</h3>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r1.jpg" alt="" /></a>
					<div class="time small-time">
						<p>2:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra viverra nullam nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r2.jpg" alt="" /></a>
					<div class="time small-time">
						<p>3:02</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r3.jpg" alt="" /></a>
					<div class="time small-time">
						<p>1:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r4.jpg" alt="" /></a>
					<div class="time small-time">
						<p>2:09</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum viverra nullam metus varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="recommended-grids">
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r4.jpg" alt="" /></a>
					<div class="time small-time">
						<p>6:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r5.jpg" alt="" /></a>
					<div class="time small-time">
						<p>7:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r6.jpg" alt="" /></a>
					<div class="time small-time">
						<p>6:09</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/r1.jpg" alt="" /></a>
					<div class="time small-time">
						<p>9:04</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="recommended">
		<div class="recommended-grids">
			<div class="recommended-info">
				<h3>Sports</h3>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/g.jpg" alt="" /></a>
					<div class="time small-time">
						<p>7:30</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/g1.jpg" alt="" /></a>
					<div class="time small-time">
						<p>9:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum viverra nullam metus varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/g2.jpg" alt="" /></a>
					<div class="time small-time">
						<p>5:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/g3.jpg" alt="" /></a>
					<div class="time small-time">
						<p>6:55</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="recommended-grids">
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/we2.jpg" alt=""></a>
					<div class="time small-time">
						<p>7:30</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/we1.jpg" alt=""></a>
					<div class="time small-time">
						<p>9:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum viverra nullam metus varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/we4.jpg" alt=""></a>
					<div class="time small-time">
						<p>5:34</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Varius sit sed viverra nullam viverra nullam interdum metus</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 resent-grid recommended-grid">
				<div class="resent-grid-img recommended-grid-img">
					<a href="single.html"><img src="/assets/customer/images/we3.jpg" alt=""></a>
					<div class="time small-time">
						<p>6:55</p>
					</div>
					<div class="clck small-clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info video-info-grid">
					<h5><a href="single.html" class="title">Nullam interdum metus viverra nullam varius sit sed viverra</a></h5>
					<ul>
						<li><p class="author author-info"><a href="#" class="author">John Maniya</a></p></li>
						<li class="right-list"><p class="views views-info">2,114,200 views</p></li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

@endsection