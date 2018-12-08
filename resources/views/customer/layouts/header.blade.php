
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:;"><h1><img src="/images/logo.png" alt="" /></h1></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<div class="top-search">
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control search-input col-md-12" placeholder="Tìm kiếm khóa học ...">
					<input type="submit" value=" ">
				</form>
			</div>
			<div class="header-top-right">
				<div class="file">
					<a href="{{route('logout')}}">Đăng xuất</a>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</nav>
@push('js')
<script>

	$(document).ready(function($) {
		var engine1 = new Bloodhound({
			remote: {
				url: '/customer/search/name?value=%QUERY%',
				wildcard: '%QUERY%'
			},
			datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace
		});

		$(".search-input").typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		}, [
		{
			source: engine1.ttAdapter(),
			name: 'students-name',
			display: function(data) {
				return data.name;
			},
			templates: {
				empty: [
				'<div class="header-title"></div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
				],

				suggestion: function (data) {
					return '<a href="/customer/khoa-hoc/aaa_c_' + data.id + '" class="list-group-item">' + data.title + '</a>';
				}
			}
		}
		]);


	});
</script>
@endpush