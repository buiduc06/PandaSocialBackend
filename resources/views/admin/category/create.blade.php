@extends('admin.layouts.main')
@section('content')

<div class="col-sm-8 container">
	<div class="card card-body">
		<h4 class="card-title">DANH MỤC KHÓA HỌC</h4>
		<h5 class="card-subtitle"> Thêm danh mục mới </h5>
		<form class="form-horizontal m-t-30" action="{{route('admin.category.store')}}" method="POST">

			<div class="form-group">
				<label>Tên danh mục</label>
				<input type="text" class="form-control" name="name" value="{{old('name', '')}}">
				<span class="help-block"><small></small></span>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('name')}}</small></span>
				@endif
			</div>


			<div class="form-group">
				<label>Thứ tự</label>
				<input type="text" class="form-control" name="order_by" value="0">
				<span class="help-block"><small></small></span>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('order_by')}}</small></span>
				@endif
			</div>

			@if(!empty($categories))

			<div class="form-group">
				<label>Danh mục cha</label>
				<select class="custom-select col-12" name="parent_id" id="inlineFormCustomSelect">
					<option value="0">chọn</option>
					@foreach($categories as $item)
					<option value="{{$item->id}}"
						{{old('parent_id', '') == $item->id ? 'selected' : ''}}
						>{{$item->name}}</option>
						@endforeach
					</select>
					@if(count($errors) > 0)
					<span class="help-block text-danger"><small>{{$errors->first('name')}}</small></span>
					@endif
				</div>
				@endif

				<div class="form-group">
					<label>Trạng thái</label>
					<select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
						@foreach(foo_status() as $key => $item)
						<option value="{{$key}}"
						{{old('status', '') == $key ? 'selected' : ''}}
						>{{$item}}</option>
						@endforeach
					</select>
					@if(count($errors) > 0)
					<span class="help-block text-danger"><small>{{$errors->first('status')}}</small></span>
					@endif
				</div>
			{{-- <div class="form-group">
				<label>Text area</label>
				<textarea class="form-control" rows="5"></textarea>
			</div> --}}

			<div class="form-actions">
				<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			</div>


		</form>
	</div>
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