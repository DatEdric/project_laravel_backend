<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ImportBook;
use App\Http\Requests\ImportBookRequest;

class AdminImportBookController extends Controller
{
    public function __construct()
    {

        view()->share([
            'activeMenu' => 'ImportBook',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('get.list.book')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $listImportBook = ImportBook::with('book:id,b_name')->where('ib_books_id', $id)->orderByDesc('id')->paginate('10');
        return view('backend.import_books.index', compact('listImportBook', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportBookRequest $request, $id)
    {
        //
        $data = $request->except('_token');
        $data['ib_books_id'] = $id;
        $data['created_at'] = now();
        \DB::beginTransaction();
        try {
            ImportBook::insert($data);
            \DB::commit();
            return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
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
        $importBook = ImportBook::findOrFail($id);
        if (!$importBook) {
            return redirect()->route('get.list.import_books')->with('danger', 'Dữ liệu không tồn tại..');
        }
        try {
            $importBook->delete();
            return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }
}
