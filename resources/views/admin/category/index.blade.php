@extends('admin.layouts.main')
@section('content')

<div class="container-fluid table_custom">
	<div class="table-wrapper table_custom">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Danh mục khóa học</h2>
				</div>
				<div class="col-sm-6">
					<a href="{{route($route_create)}}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Thêm danh mục mới</span></a>
					<a href="#deleteEmployeeModal" class="btn btn-danger delete_mute"><i class="material-icons">&#xE15C;</i> <span class="mr-1">Delete</span>
						<span class='number_delete check_number_delete'></span>
					</a>
				</div>
			</div>
		</div>

		<form class="table-filter" action="" method="GET" id="filter_form">
			<div class="row">
				<div class="col-sm-3">
					<div class="show-entries">
						<span>Show</span>
						<select class="form-control change_filter" name="perpage">
							@foreach(foo_show_pg() as $item)
							<option value="{{$item}}"
							{{Request::get('perpage') == $item ? 'selected' : ''}}
							>{{$item}}</option>
							@endforeach
						</select>
						<span>entries</span>
					</div>
				</div>
				<div class="col-sm-9">
					<button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
					<div class="filter-group">
						<label>Name</label>
						<input type="text" class="form-control change_filter" name="name" value="{{Request::get('name')}}">
					</div>

					<div class="filter-group">
						<label>Status</label>
						<select class="form-control change_filter" name="status">
							<option value="" selected>chọn</option>
							@foreach(foo_status() as $key => $item)
							<option value="{{$key}}"
							{{Request::get('status') == $key && !empty(Request::get('status'))? 'selected' : ''}}
							>{{$item}}</option>
							@endforeach
						</select>
					</div>
					<span class="filter-icon"><i class="fa fa-filter"></i></span>
				</div>
			</div>
		</form>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th>#</th>
					<th>Tên danh mục</th>
					<th>Trạng thái</th>
					<th>Số khóa học</th>
					<th>Danh mục cha</th>
					<th>Ngày tạo</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php $ii = 0; @endphp
				@foreach($categories as $category)

				<tr>
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="delete_mute_value" id="checkbox1" name="options[]" value="{{$category->id}}">
							<label for="checkbox1"></label>
						</span>
					</td>
					<td>{{++$ii}}</td>
					<td>{{$category->name}}</td>
					<td>{!!checkActive($category->status)!!}</td>
					<td>{{empty($category->course) ? 0 : count($category->course)}}</td>
					<td>{{$category->getParent()}}</td>
					<td>{{convertDate($category->created_at)}}</td>
					<td>
						<a href="{{route($route_edit)}}/{{$category->id}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
						<a href="javascript:;" data-id="{{$category->id}}" class="delete delete_one"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		<div class="clearfix">
			<div class="hint-text">Showing <b>{{$categories->currentPage()}}</b> out of <b>{{$categories->total()}}</b> entries</div>
			{{$categories->links('pagination::custome-pg')}}
		</div>
	</div>
</div>


<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route($route_destroy)}}" method="POST">
				<input type="hidden" name="list_id" class="list_id" value="">
				<div class="modal-header">
					<h4 class="modal-title">Xóa bản ghi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Bạn có chăc chắn muốn xóa <span class='number_delete check_number_delete'></span> bản ghi này ?</p>
					<p class="text-warning"><small>Hành động này không thể được hoàn tác.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
