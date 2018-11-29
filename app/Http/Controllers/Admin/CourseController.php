<?php

namespace App\Http\Controllers\Admin;

use App\course;
use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route_create       = 'admin.course.create';
        $route_edit         = 'admin.course.edit';
        $route_destroy      = 'admin.course.destroy';

        $model = course::with(['video', 'category', 'adminUser']);

        if ($request->filled('perpage')) {
            $perpage = $request->perpage;
        } else {
            $perpage = 5;
        }
        if ($request->filled('title')) {
            $model->where('title', 'like', '%'.$request->name.'%');
        }

        if ($request->filled('status')) {
            $model->where('status', $request->status);
        }

        $cources = $model->paginate($perpage);

        return view(
            'admin.course.index',
            compact(
                'cources',
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        return view('admin.course.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(course $course)
    {
        //
    }
}
