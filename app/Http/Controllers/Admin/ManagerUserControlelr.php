<?php

namespace App\Http\Controllers\Admin;

use App\courseVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ManagerUserControlelr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $route_create       = 'admin.manager_user.create';
        // $route_edit         = 'admin.manager_user.edit';
        $route_destroy      = 'admin.manager_user.destroy';

        $model = User::with('userMeta');

        if ($request->filled('perpage')) {
            $perpage = $request->perpage;
        } else {
            $perpage = 5;
        }
        if ($request->filled('name')) {
            $model->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->filled('status')) {
            $model->where('status', $request->status);
        }

        $users = $model->paginate($perpage);

        return view(
            'admin.manager_user.index',
            compact(
                'users',
                'route_destroy'
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
        return view('admin.manager_user.create');
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
     * @param  \App\courseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function show(courseVideo $courseVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\courseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(courseVideo $courseVideo)
    {
        return view('admin.manager_user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, courseVideo $courseVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $route_index       = 'admin.manager_user.index';

        if ($request->filled('list_id')) {
            $list_id_delete = explode(',', $request->list_id);
            $block_user = User::whereIn('id', $list_id_delete)->get();

            foreach ($block_user as $user) {
                $user->blockUser();
            }
            if ($block_user) {
                return redirect(route($route_index))->with('msg', 'Khóa người dùng thành công');
            } else {
                return redirect(route($route_index))->with('msg_error', 'Khóa người dùng thất bại');
            }
        }
    }
}
