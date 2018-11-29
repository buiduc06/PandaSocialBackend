<?php

namespace App\Http\Controllers\Admin;

use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route_create       = 'admin.category.create';
        $route_edit         = 'admin.category.edit';
        $route_destroy      = 'admin.category.destroy';

        $model = category::with('course');

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

        $categories = $model->paginate($perpage);

        return view(
            'admin.category.index',
            compact(
                'categories',
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
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route_index       = 'admin.category.index';

        $validatedData = $request->validate(
            [
                'name'      =>'required|min:4|max:200|unique:categories',
            ],
            [
                'name.required'     =>'Trường này không được để trống',
                'name.min'          =>'Trường này phải có độ dài tối thiều 4 kí tự',
                'name.max'          =>'Trường này độ dài tối đa 200 kí tự',
                'name.unique'       =>'Danh mục đã tồn tại',
            ]
        );


        //bảo toàn data với beginTransaction
        DB::beginTransaction();

        try {
            $create = category::create($request->all());
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            dd($e);
            $success = false;
            DB::rollback();
        }
        // return dd($request);
        if ($success) {
            return redirect(route($route_index))->with('msg', 'tạo bản ghi thành công');
        } else {
            return redirect(route($route_index))->with('msg_error', 'tạo bản ghi thất bại');
        }
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
    public function edit(Request $request)
    {

        if ($request->id) {
            $find_cate = category::findOrFail($request->id);
            $categories = category::Active()->select('id', 'name')->get();
            return view('admin.category.edit', compact('find_cate', 'categories'));
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

        $find_cate = category::findOrFail($request->id);
        $route_index       = 'admin.category.index';
        $validatedData = $request->validate(
            [
                'name'      =>['required', 'min:4', 'max:200', Rule::unique('categories')->ignore($find_cate->id) ]
            ],
            [
                'name.required'     =>'Trường này không được để trống',
                'name.min'          =>'Trường này phải có độ dài tối thiều 4 kí tự',
                'name.max'          =>'Trường này độ dài tối đa 200 kí tự',
                'name.unique'       =>'Danh mục đã tồn tại',
            ]
        );
        DB::beginTransaction();
        try {
            $update_cate = $find_cate->update($request->except('id'));
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            dd($e);
            $success = false;
            DB::rollback();
        }
        if ($success) {
            return redirect(route($route_index))->with('msg', 'sửa bản ghi thành công');
        } else {
            return redirect(route($route_index))->with('msg_error', 'sửa bản ghi thất bại');
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
        $route_index       = 'admin.category.index';

        if ($request->filled('list_id')) {
            $list_id_delete = explode(',', $request->list_id);
            $delete_cate = category::destroy($list_id_delete);
            // dd($delete_cate);
            if ($delete_cate) {
                return redirect(route($route_index))->with('msg', 'xóa bản ghi thành công');
            } else {
                return redirect(route($route_index))->with('msg_error', 'xóa bản ghi thất bại');
            }
        }
    }
}
