<?php

namespace App\Http\Controllers\Admin;

use App\video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\courseVideo;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function downloadVideo($video_link)
    {
        $video = video::where('link', $video_link)->first();
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($video->getNameVideoS3()));
        header("Content-Type: video/mp4");

        return readfile($video->getNameVideoS3());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        DB::beginTransaction();

        try {

            if ($request->filled('id')) {
                $video = video::findOrFail($request->id);
                $des = courseVideo::where('video_id', $request->id)->delete();
                $video->deleteVideoS3(); // xóa trên cloud
                $video->delete();
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
            return response(200);
        } else {
            return response(500);
        }

    }


    public function upload_video(Request $request)
    {
        $data = $request->all();
        $rules = [
            'video' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'
        ];
        $validator = Validator($data, $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $video = $data['video'];
            $input = time() . $video->getClientOriginalExtension();
            $destinationPath = 'uploads/videos';
            $video->move($destinationPath, $input);

            $user['video'] = $input;
            $user['created_at'] = date('Y-m-d h:i:s');
            $user['updated_at'] = date('Y-m-d h:i:s');
            $user['user_id'] = session('user_id');
            DB::table('videos')->insert($user);
            return redirect()->back()->with('upload_success', 'upload_success');
        }
    }
}
