<div class="col-sm-3 col-md-2 sidebar">
	<div class="top-navigation">
		<div class="t-menu">MENU</div>
		<div class="t-img">
			<img src="/images/logo.png" alt="" />
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="drop-navigation drop-navigation">
		<ul class="nav nav-sidebar">
			<li>
				<a href="{{route('customer.index')}}" class="home-icon">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home
				</a>
			</li>
			<li>
				<a href="#" class="menu1">
					<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
					Danh Mục
					<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
				</a>
			</li>

			 
			<ul class="cl-effect-2">
				@foreach($cate_share as $item)
				<li>
					<a href="{{route('customer.category', ['slug'=> str_slug($item->name),'id'=>$item->id])}}">{{$item->name}}</a>
				</li>
				@endforeach
			</ul>

			<li>
				<a href="https://social.ducpanda.info">
					<span class="glyphicon glyphicon-arrow-left text-white" aria-hidden="true"></span>
					Trở về mạng xã hội
				</a>
			</li>
			<!-- script-for-menu -->
			<script>
				$( "li a.menu1" ).click(function() {
					$( "ul.cl-effect-2" ).slideToggle( 300, function() {
            			// Animation complete.
            		});
				});
			</script>

		</ul>
	</div>
</div>