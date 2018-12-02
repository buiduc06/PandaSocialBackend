@extends('admin.layouts.main')
@push('css')
<link href="/plugin/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="/plugin/bootstrap-fileinput-master/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/plugin/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    
@endpush
@section('content')

<div class="col-sm-12 container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="card card-body">
                <h4 class="card-title">KHÓA HỌC</h4>
                <h5 class="card-subtitle"> Thêm khóa học mới </h5>
                <form class="form-horizontal m-t-30" action="{{route('admin.course.update')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$course->id}}">
                    <div class="form-group">
                        <label>Tên khóa học</label>
                        <input type="text" class="form-control" name="title" value="{{$course->title}}">
                        <span class="help-block"><small></small></span>
                        @if(count($errors) > 0)
                        <span class="help-block text-danger"><small>{{$errors->first('title')}}</small></span>
                        @endif
                    </div>

                     <div class="row">
                            @if(!empty($categories))
                            <div class="form-group col-6">
                                <label>Danh mục khóa học</label>
                                <select class="custom-select col-12" name="category_id" id="inlineFormCustomSelect">
                                    <option value="">chọn</option>
        
                                    @foreach($categories as $item)
                                    <option value="{{$item->id}}" {{$course->category_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
        
                                @if(count($errors) > 0)
                                <span class="help-block text-danger"><small>{{$errors->first('category_id')}}</small></span>
                                @endif
                            </div>
                            @endif
        
                            <div class="form-group col-6">
                                <label>Trạng thái</label>
                                <select class="custom-select col-12" name="status" id="inlineFormCustomSelect">
                                    @foreach(foo_status() as $key => $item)
                                    <option value="{{$key}}" {{old('status', '') == $key ? 'selected' : ''}}>{{$item}}</option>
                                    @endforeach
                                </select>
                                @if(count($errors) > 0)
                                <span class="help-block text-danger"><small>{{$errors->first('status')}}</small></span>
                                @endif
                            </div>
                     </div>
                    <input type="hidden" name="created_by" value="{{Auth::id()}}">

                    <div class="form-group">
                        <label>Mô tả ngắn</label>
                        <textarea class="form-control" rows="3" name="summary">{{$course->summary}}</textarea>
                        @if(count($errors) > 0)
                        <span class="help-block text-danger"><small>{{$errors->first('summary')}}</small></span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nội dung khóa học</label>
                        <textarea class="form-control" rows="5" name="description">{{$course->description}}</textarea>
                        @if(count($errors) > 0)
                        <span class="help-block text-danger"><small>{{$errors->first('description')}}</small></span>
                        @endif
                    </div>

                  
                    <div class="form-group">
                        <label>video khóa học</label>
                        
                      
                        <div class="form-group">
                                <div class="file-loading">
                                    <input id="file-1" type="file" multiple class="file" name="video[]" data-overwrite-initial="false" data-min-file-count="2" data-theme="fas">
                                </div>
                            </div>
                            <hr>
                     

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

        <div class="col-sm-3">
            <div class="card card-body">
                    {{--  <h4 class="card-title">KHÓA HỌC</h4>  --}}
                    <h5> Tùy chọn </h5>
            </div>
        </div>
    </div>
</div>
 
@foreach($course->video as $item)
<input type="hidden" value="{{$item->getVideoS3()}}" class="img_old" data-size="{{$item->size}}" data-name="{{$item->title}}" data-delete="{{route('admin.video.delete.video', ['id'=>$item->id])}}">
 @endforeach
@endsection
@push('js')
<script src="/plugin/bootstrap-fileinput-master/js/plugins/sortable.min.js"></script>
<script src="/plugin/bootstrap-fileinput-master/js/plugins/purify.min.js"></script>
<script src="/plugin/bootstrap-fileinput-master/js/fileinput.js"></script>
{{--  <script src="/js/form_upload.js"></script>  --}}

     
    <script src="/plugin/bootstrap-fileinput-master/themes/fas/theme.js" type="text/javascript"></script>
    <script src="/plugin/bootstrap-fileinput-master/themes/explorer-fas/theme.js" type="text/javascript"></script>

    <script>
var img_old = [];
var img_meta = [];
var flag = 0;
         $.each($('.img_old'), function( index, value ) {
            img_old[flag] = $('.img_old').eq(index).val();
            img_meta[flag] = 
                {
                type: "video", 
                size: $('.img_old').eq(index).attr("data-size"),
                filetype: "video/mp4",
                caption: $('.img_old').eq(index).attr("data-name"), 
                url: $('.img_old').eq(index).attr("data-delete"),
                key: 3,
                downloadUrl: $('.img_old').eq(index).val(), // override url
                filename: $('.img_old').eq(index).attr("data-name") // override download filename
                }
                ;
            flag++;
          });
{{-- console.log(img_meta); --}}
         

            $("#file-1").fileinput({
                theme: 'fas',
                uploadUrl: '/', // you must set a valid URL here else you will get an error
                //allowedFileExtensions: ['mp4', 'm4a', 'webm'],
                overwriteInitial: false,
                maxFileSize: 1000000,
                maxFilesNum: 10,
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        overwriteInitial: false,
        initialPreviewAsData: true,
        initialPreview: img_old,
        initialPreviewConfig: img_meta,
                //allowedFileTypes: ['image', 'video', 'flash'],
                allowedFileTypes: ['video'],
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                }
            });
             $('form').submit(function(){
                $('#preloader_2').modal('show');
             });
              
        </script>
 
@endpush