<?php

namespace App\Http\Controllers\Admin;

use App\course;
use App\category;
use App\video;
use App\courseVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use VideoThumbnail;

class CourseController extends Controller
{
    protected $route_index = 'admin.course';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route_create = 'admin.course.create';
        $route_edit = 'admin.course.edit';
        $route_destroy = 'admin.course.destroy';

        $model = course::with(['video', 'category', 'adminUser']);

        if ($request->filled('perpage')) {
            $perpage = $request->perpage;
        } else {
            $perpage = 5;
        }
        if ($request->filled('title')) {
            $model->where('title', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')) {
            $model->where('status', $request->status);
        }

        $courses = $model->paginate($perpage);

        return view(
            'admin.course.index',
            compact(
                'courses',
                'route_destroy',
                'route_create',
                'route_edit'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::Active()->select('id', 'name')->get();
        return view('admin.course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $thumbnail = VideoThumbnail::createThumbnail(
        //     public_path('uploads/videos/abb.mp4'),
        //     public_path('uploads/video_thumbs'),
        //     'aaaaa.jpg',
        //     20,
        //     150,
        //     150
        // );
        // dd($thumbnail);
        $validatedData = $request->validate(
            [
            'title' => 'required|min:4|max:200',
            'summary' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            ],
            [
            'title.required' => 'Trường này không được để trống',
            'title.min' => 'Trường này phải có độ dài tối thiều 4 kí tự',
            'title.max' => 'Trường này độ dài tối đa 200 kí tự',
            'summary.required' => 'Trường này không được để trống',
            'status.required' => 'Trường này không được để trống',
            'category_id.required' => 'Trường này không được để trống',
            ]
        );




        // dd($request->category_id);
        //bảo toàn data với beginTransaction
        DB::beginTransaction();

        try {
            if ($request->file('image')) {
                $file = $request->image;
                $uploadPath = public_path('/uploads'); // Thư mục upload
                $fileExtension =  $file->getClientOriginalExtension();
                $image_name = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
                $file->move($uploadPath, $image_name);
            }

            if ($request->file('video')) {
                $filename = uploadFiles($request->file('video'));

                foreach ($filename as $key => $item) {
                    $item['title'] = '0'.$key.' - '.$request->title;
                    $video_data = video::create($item);
                    $thumb_video = md5($video_data->title);
                    $thumb_img = VideoThumbnail::createThumbnail($video_data->getVideoS3(), public_path('uploads/video_thumbs/'), $thumb_video, 2, 1920, 1080);

                    $video_data->update(['images'=>$thumb_video]);
                    $video[] = $video_data;
                }
            } else {
                $video = '';
            }
            $data_course = [
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'summary' => $request->summary,
            'slug' => str_slug($request->title),
            'status' => 1,
            'category_id' => $request->category_id,
            'images' => $image_name ? $image_name : '',

            ];
            $course = course::create($data_course);
            if ($video) {
                foreach ($video as $item) {
                    $insert_courseVideo[] = [
                    'course_id' => $course->id,
                    'video_id' => $item->id,
                    'order_by' => 0,
                    'status' => 1
                    ];
                }
                courseVideo::insert($insert_courseVideo);
            }


            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            dd($e);
            $success = false;
            DB::rollback();
        }
        // return dd($request);
        if ($success) {
            return redirect(route($this->route_index))->with('msg', 'tạo bản ghi thành công');
        } else {
            return redirect(route($this->route_index))->with('msg_error', 'tạo bản ghi thất bại');
        }
    }
    public function edit(request $request)
    {
        // $disk = Storage::disk('s3')->allFiles();
        // dd($disk);
        if ($request->id) {
            $course = course::findOrFail($request->id);
            $categories = category::Active()->Parents()->select('id', 'name')->get();
            return view('admin.course.edit', compact('course', 'categories'));
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate(
            [
            'title' => 'required|min:4|max:200',
            'summary' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            ],
            [
            'title.required' => 'Trường này không được để trống',
            'title.min' => 'Trường này phải có độ dài tối thiều 4 kí tự',
            'title.max' => 'Trường này độ dài tối đa 200 kí tự',
            'summary.required' => 'Trường này không được để trống',
            'status.required' => 'Trường này không được để trống',
            'category_id.required' => 'Trường này không được để trống',
            ]
        );

        // dd($request->category_id);
        //bảo toàn data với beginTransaction
        DB::beginTransaction();

        try {
            $data_find = course::findOrFail($request->id);
 
            if ($request->file('image')) {
                $file = $request->image;
                $uploadPath = public_path('/uploads'); // Thư mục upload
                $fileExtension =  $file->getClientOriginalExtension();
                $image_name = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
                $file->move($uploadPath, $image_name);
            }

            if ($request->file('video')) {
                $filename = uploadFiles($request->file('video'));

                foreach ($filename as $item) {
                    $video_data = video::create($item);
                    $thumb_video = md5($video_data->title);
                    $thumb_img = VideoThumbnail::createThumbnail($video_data->getVideoS3(), public_path('uploads/video_thumbs/'), $thumb_video, 2, 1920, 1080);

                    $video_data->update(['images'=>$thumb_video]);
                    $video[] = $video_data;
                }
            } else {
                $video = '';
            }
            // dd($data_find->images);
            $data_course = [
            'title' => $request->title,
            'description' => $request->description,
            'summary' => $request->summary,
            'slug' => str_slug($request->title),
            'status' => 1,
            'category_id' => $request->category_id,
            'images' => $image_name ? $image_name : $data_find->images,

            ];
            $course = $data_find->update($data_course);
            if ($video) {
                foreach ($video as $item) {
                    $insert_courseVideo[] = [
                        'course_id' => $data_find->id,
                        'video_id' => $item->id,
                        'order_by' => 0,
                        'status' => 1
                    ];
                }
                courseVideo::insert($insert_courseVideo);
            }

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            dd($e);
            $success = false;
            DB::rollback();
        }
        // return dd($request);
        if ($success) {
            return redirect(route($this->route_index))->with('msg', 'cập nhật ghi thành công');
        } else {
            return redirect(route($this->route_index))->with('msg_error', 'cập nhật ghi thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        // dd($request);

        DB::beginTransaction();

        try {
            if ($request->filled('list_id')) {
                $list_id_delete = explode(',', $request->list_id);
                $delete_course = course::destroy($list_id_delete);
            }

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            dd($e);
            $success = false;
            DB::rollback();
        }

            // dd($delete_cate);
        if ($delete_course) {
            return redirect(route($this->route_index))->with('msg', 'xóa bản ghi thành công');
        } else {
            return redirect(route($this->route_index))->with('msg_error', 'xóa bản ghi thất bại');
        }
    }
}
