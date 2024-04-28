<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Category',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        $viewData = [
            'categories' => $categories
        ];
        return view('backend.category.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        if ($this->createOrUpdate($request)) {
            return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
        }
        return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('get.list.category')->with('danger', 'Dữ liệu không tồn tại.');
        }

        return view('backend.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        if ($this->createOrUpdate($request, $id)) {
            return redirect()->back()->with('success', 'Cập nhật thành công dữ liệu.');
        }
        return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect()->route('get.list.category')->with('danger', 'Dữ liệu không tồn tại..');
        }
        try {
            $category->delete();
            return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }

    public function createOrUpdate($request, $id = '')
    {
        $category = new Category();
        if ($id) {
            $category = Category::findOrFail($id);
        }
        $category->c_name = $request->c_name;
        if (!$category->save()) {
            return false;
        }
        return true;
    }
}
