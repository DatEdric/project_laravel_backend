<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reader;
use App\Models\Department;
use App\Models\Classs;
use App\Http\Requests\ReaderRequest;
use App\Helpers\HelpersFun;

class AdminReaderController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Reader',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $departments = Department::all();
        $class = Classs::all();
        $readers = Reader::with('class:id,c_name', 'department:id,d_name');
        if ($request->r_name) {
            $readers = $readers->where('r_name', 'like', '%' . $request->r_name . '%');
        }
        if ($request->code_card) {
            $readers = $readers->where('r_code_card', $request->code_card);
        }

        if ($request->r_birthday) {
            $readers = $readers->where('r_birthday', $request->r_birthday);
        }

        if ($request->r_department_id) {
            $readers = $readers->where('r_department_id', $request->r_department_id);
        }
        if ($request->r_class_id) {
            $readers = $readers->where('r_class_id', $request->r_class_id);
        }
        if ($request->r_gender) {
            $readers = $readers->where('r_gender', $request->r_gender);
        }
        $readers = $readers->orderBy('id', 'DESC')->paginate(10);

        $viewData = [
            'departments' => $departments,
            'class' => $class,
            'readers' => $readers
        ];
        return view('backend.reader.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::all();
        $class = Classs::all();
        return view('backend.reader.create', compact('departments', 'class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReaderRequest $request)
    {
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
        $reader = Reader::find($id);
        if (!$reader) {
            return redirect()->route('get.list.reader')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $departments = Department::all();
        $class = Classs::all();
        return view('backend.reader.update', compact('departments', 'class', 'reader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReaderRequest $request, $id)
    {
        //
        $this->createOrUpdate($request, $id);
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
        $reader = Reader::findOrFail($id);
        if (!$reader) {
            return redirect()->route('get.list.suppliers')->with('danger', 'Dữ liệu không tồn tại..');
        }
        try {
            $this->deleteImageReader($reader);
            $reader->delete();

            return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }

    public function readerBook(Request $request, $id)
    {
        $reader = Reader::find($id);
        if (!$reader) {
            return redirect()->route('get.list.reader')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $books = Order::with('book:id,b_name')->where('d_reader_id', $id);
        $forfeit = Order::where('d_reader_id', $id)->whereIn('d_status', [3, 4])->sum('d_forfeit');

        if ($request->name_book) {
            $bookId = Book::where('b_name', 'like', '%' . $request->name_book . '%')->pluck('id');
            if (!empty($bookId)) {
                $books = $books->whereIn('d_book_id', $bookId);
            }
        }
        $books = $books->orderByDesc('id')->paginate(10);
        return view('backend.reader.list_borrow', compact('reader', 'books', 'forfeit'));
    }

    /**
     * @param $request
     * @param null $id
     * @return bool
     */
    public function createOrUpdate($request, $id = NULL)
    {
        $data = $request->except('_token', 'images');

        if ($id !== NULL) {
            $reader = Reader::find($id);
        }

        if ($request->hasFile('images')) {
            if (isset($reader)) {
                $this->deleteImageReader($reader);
            }
            $image = $request->file('images');
            $nameimg = HelpersFun::getNameImage($image, 'avatar');
            $data['r_avatar'] = $nameimg;
        }

        if ($request->r_birthday) {
            $data['r_birthday'] = convertDate($request->r_birthday);
        }

        if ($request->r_card_created_date) {
            $data['r_card_created_date'] = convertDate($request->r_card_created_date);
        }

        if ($request->r_card_expiry_date) {
            $data['r_card_expiry_date'] = convertDate($request->r_card_expiry_date);
        }

        $data['updated_at'] = now();

        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $data['created_at'] = now();
                Reader::insert($data);
            } else {
                $reader->update($data);
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }

    /**
     * @param $reader
     */
    public function deleteImageReader($reader)
    {
        HelpersFun::deleteImage('uploads/avatar/' . $reader->p_images);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function previewCard(Request $request, $id)
    {
        if ($request->ajax()) {
            $reader = Reader::with('class:id,c_name', 'department:id,d_name')->find($id);
            $html =  view('backend.reader.view_card', compact('reader'))->render();
            return response([
                'html' => $html
            ]);
        }
    }
}
