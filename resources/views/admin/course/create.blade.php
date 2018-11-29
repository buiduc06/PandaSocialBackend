@extends('admin.layouts.main')
@section('content')

<div class="col-sm-9 container">
	<div class="card card-body">
		<h4 class="card-title">KHÓA HỌC</h4>
		<h5 class="card-subtitle"> Thêm khóa học mới </h5>
		<form class="form-horizontal m-t-30" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label>Tên khóa học</label>
				<input type="text" class="form-control" name="title" value="{{old('title', '')}}">
				<span class="help-block"><small></small></span>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('title')}}</small></span>
				@endif
			</div>

			@if(!empty($categories))
			<div class="form-group">
				<label>Danh mục khóa học</label>
				<select class="custom-select col-12" name="category_id" id="inlineFormCustomSelect">
					<option value="0">chọn</option>

					@foreach($categories as $item)
					<option value="{{$item->id}}" {{old('category_id', '') == $item->id ? 'selected' : ''}} >{{$item->name}}</option>
					@endforeach
				</select>

				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('category_id')}}</small></span>
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
			<input type="hidden" name="created_by" value="{{Auth::id()}}">

						<div class="form-group">
				<label>Mô tả ngắn</label>
				<textarea class="form-control" rows="3" name="summary">{{old('summary', '')}}</textarea>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('summary')}}</small></span>
				@endif
			</div>

			<div class="form-group">
				<label>Nội dung khóa học</label>
				<textarea class="form-control" rows="5" name="description">{{old('description', '')}}</textarea>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('description')}}</small></span>
				@endif
			</div>


			<div class="form-group">
				<label>video khóa học</label>
				<textarea class="form-control" rows="5" name="description">{{old('description', '')}}</textarea>
				@if(count($errors) > 0)
				<span class="help-block text-danger"><small>{{$errors->first('description')}}</small></span>
				@endif
			</div>



			<div class="form-actions">
				<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			</div>


		</form>
	</div>
</div>



@endsection
