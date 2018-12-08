<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\User;
use App\course;
use App\video;
use App\category;
use Auth;
use DB;
use App\Http\Resources\CourseResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['data'] = course::orderby('id', 'DESC')->get();
        $data['recent_videos'] = course::orderby('id', 'DESC')->paginate(3);
        // chỉ lấy ra danh mục có các khóa học
        $data['categories'] = category::with('course')->has('course')->get();

        return view('customer.course.index', $data);
    }

    public function getCourseByCategory(request $request)
    {
     
        if ($request->id) {
            $data['category'] = category::orderby('id', 'DESC')->findOrFail($request->id);

            return view('customer.course.category', $data);
        }
    }

    public function getListUser()
    {
        return view('customer.course.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course(request $request)
    {
        $order = 'DESC';
        $video_id = $request->video_id;
        $course = course::with(['video' => function ($q) use ($order, $video_id) {
 
            $q->orderBy('id', $order);
        }])->orderby('id', 'DESC')->findOrFail($request->id);

        if ($video_id && $video_first = optional($course->video)->where('id', $video_id)->first()) {
            $data['video_first'][] = $video_first;
        } else {
            $data['video_first'][] = optional($course->video->where('id', '!=', $video_id))->first();
        }

        $data['course'] = $course;
        return view('customer.video.index', $data);
    }

    public function getManagerUser()
    {
        return view('customer.course.index');
    }

    public function getData()
    {
        return Datatables::of(User::query())->make(true);
    }

    public function postComment(request $request)
    {
        if ($request->filled('course_id')) {
            DB::beginTransaction();
            try {
                $course = course::findOrFail($request->course_id);
                $request['user_id'] = Auth::id();

                // tạo bình luận mới qua relationships
                $course->commentVideos()->create($request->all());

                DB::commit();
                $success = true;
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                $success = false;
            }
            if ($success) {
                return redirect()->back()->with('msg', 'Đăng Bình luận thành công');
            } else {
                return redirect()->back()->with('msg_error', 'Đăng Bình luận thất bại');
            }
        }
    }

    public function searchByName(Request $request)
    {
        $video = course::where('title', 'like', '%' . $request->value . '%')->get();

        $data = CourseResource::collection($video);
        return response()->json($data);
    }
}
