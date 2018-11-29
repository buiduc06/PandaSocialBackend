@extends('admin.layouts.main')
@section('content')
<style type="text/css" media="screen">
	div{
		font-family: Arial;
	}
</style>
<div class="row">
	<!-- Column -->
	<div class="col-sm-12 col-md-6">
		<div class="card bg-success">
			<div class="card-body text-white">
				<div class="d-flex flex-row">
					<div class="align-self-center display-6"><i class="ti-wallet"></i></div>
					<div class="p-10 align-self-center">
						<h4 class="m-b-0">Tổng số khóa học</h4>
						<span>course</span>
					</div>
					<div class="ml-auto align-self-center">
						<h2 class="font-medium m-b-0">{{$count_course}}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-sm-12 col-md-6">
		<div class="card bg-info">
			<div class="card-body text-white">
				<div class="d-flex flex-row">
					<div class="display-6 align-self-center"><i class="ti-user"></i></div>
					<div class="p-10 align-self-center">
						<h4 class="m-b-0">Tổng số người dùng kích hoạt
						</h4>
						<span>Users</span>
					</div>
					<div class="ml-auto align-self-center">
						<h2 class="font-medium m-b-0">{{$count_user}}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-sm-12 col-md-6">
		<div class="card bg-cyan">
			<div class="card-body text-white">
				<div class="d-flex flex-row">
					<div class="display-6 align-self-center"><i class="ti-calendar"></i></div>
					<div class="p-10 align-self-center">
						<h4 class="m-b-0">Tổng số danh mục</h4>
						<span>category</span>
					</div>
					<div class="ml-auto align-self-center">
						<h2 class="font-medium m-b-0">{{$count_category}}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-sm-12 col-md-6">
		<div class="card bg-orange">
			<div class="card-body text-white">
				<div class="d-flex flex-row">
					<div class="display-6 align-self-center"><i class="ti-settings"></i></div>
					<div class="p-10 align-self-center">
						<h4 class="m-b-0">Tổng số video</h4>
						<span>video</span>
					</div>
					<div class="ml-auto align-self-center">
						<h2 class="font-medium m-b-0">{{$count_video}}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
</div>




@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
@endsection