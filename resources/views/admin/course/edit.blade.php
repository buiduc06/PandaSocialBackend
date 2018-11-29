@extends('admin.layouts.main')
@section('content')

<div class="col-sm-8 container">
	<div class="card card-body">
		<h4 class="card-title">DANH MỤC KHÓA HỌC</h4>
		<h5 class="card-subtitle"> Sửa danh mục </h5>
		<form class="form-horizontal m-t-30" action="{{route('admin.category.update')}}" method="POST">
			<input type="hidden" name="id" value="{{$find_cate->id}}">

			<div class="form-group">
				<label>Tên danh mục</label>
				<input type="text" class="form-control" name="name" value="{{$find_cate->name}}">
				<span class="help-block"><small></small></span>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('name')}}</small></span>
				@endif
			</div>

			<div class="form-group">
				<label>Thứ tự</label>
				<input type="text" class="form-control" name="order_by" value="{{$find_cate->order_by}}">
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
						{{$find_cate->parent_id == $item->id ? 'selected' : ''}}
						>{{$item->name}}</option>
						@endforeach
					</select>
					@if(count($errors) > 0)
					<span class="help-block text-danger"><small>{{$errors->first('parent_id')}}</small></span>
					@endif
				</div>
				@endif

				<div class="form-group">
					<label>Trạng thái</label>
					<select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
						@foreach(foo_status() as $key => $item)
						<option value="{{$key}}"
						{{$find_cate->status == $key ? 'selected' : ''}}
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
