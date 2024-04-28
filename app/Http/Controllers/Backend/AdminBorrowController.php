<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reader;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Order;

class AdminBorrowController extends Controller
{
    public function __construct()
    {
        $readers = Reader::where('r_status', 1)->get();
        $books = Book::where('b_status', 1)->get();
        view()->share([
            'activeMenu' => 'Borrow',
            'readers' => $readers,
            'books' => $books
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
        $borrows = Borrow::with('reader:id,r_name');
        if ($request->code_borrow) {
            $borrows = $borrows->where('b_code_borrow', $request->code_borrow);
        }
        if ($request->b_reader_id) {
            $borrows = $borrows->where('b_reader_id', $request->b_reader_id);
        }
        $borrows = $borrows->orderBy('id', 'DESC')->paginate(10);

        return view('backend.borrow.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.borrow.create');
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
        $borrow = Borrow::with('orders')->find($id);

        if (!$borrow) {
            return redirect()->route('get.list.borrow')->with('danger', 'Dữ liệu không tồn tại.');
        }
        return view('backend.borrow.update', compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $borrow = Borrow::findOrFail($id);
        if (!$borrow) {
            return redirect()->route('get.list.borrow')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $borrow->delete();
        return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
    }

    public function deleteOrders($id)
    {
        $order = Order::findOrFail($id);
        if (!$order) {
            return redirect()->route('get.list.borrow.book')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $order->delete();
        return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     *
     */
    public function ajaxAddRow(Request $request)
    {
        if ($request->ajax()) {
            $location = intval($request->location) + 1;
            $action = $request->action;
            $type = true;
            $html =  view('components.import_row_table', compact('location', 'type', 'action'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function ajaxViewBorrow(Request $request, $id)
    {
        if ($request->ajax()) {
            $borrow = Borrow::with([
                'orders' => function ($orders) {
                    $orders->select('*')->with('book');
                },
                'reader:id,r_name'
            ])->find($id);
            $html =  view('components.view_brrow', compact('borrow'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listBorrowBook(Request $request)
    {
        $activeMenu = 'ListBorrowBook';
        $books = Order::with('book:id,b_name', 'reader:id,r_name');

        if ($request->name_book) {
            $bookId = Book::where('b_name', 'like', '%' . $request->name_book . '%')->pluck('id');
            if (!empty($bookId)) {
                $books = $books->whereIn('d_book_id', $bookId);
            }
        }
        if ($request->name_reader) {
            $readerId = Reader::where('r_name', 'like', '%' . $request->name_reader . '%')->pluck('id');
            if (!empty($readerId)) {
                $books = $books->whereIn('d_reader_id', $readerId);
            }
        }
        if ($request->d_expiry_date) {
            $books = $books->where('d_expiry_date', $request->d_expiry_date);
        }

        if ($request->d_status && $request->d_status !== '5') {
            $books = $books->where('d_status', $request->d_status);
        }
        if ($request->d_status == 5) {
            $books = $books->where('d_expiry_date', '>=',  now());
        }

        $books = $books->orderByDesc('id')->paginate(10);
        return view('backend.borrow.list_borrow_book', compact('books', 'activeMenu'));
    }

    /**
     * @param $request
     * @param null $id
     * @return bool
     */

    public function createOrUpdate($request, $id = NULL)
    {
        if ($id !== NULL) {
            $borrow = Borrow::find($id);
        }

        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $borrow = new Borrow();
                $borrow->b_code_borrow = $request->b_code_borrow;
                $borrow->b_reader_id = $request->b_reader_id;
                $borrow->b_note = $request->b_note;

                if ($borrow->save()) {

                    if (!empty($request->d_book_id)) {
                        $bookId = $request->d_book_id;
                        $number = $request->d_number;
                        $expiryDate = $request->d_expiry_date;
                        $note = $request->d_note;
                        foreach ($bookId as $key => $book) {
                            $order = new Order();
                            $order->d_borrow_id = $borrow->id;
                            $order->d_book_id = $book;
                            $order->d_reader_id = $request->b_reader_id;
                            $order->d_number = $number[$key];
                            $order->d_expiry_date = $expiryDate[$key];
                            $order->d_note = $note[$key];
                            $order->d_status = 1;
                            $order->save();
                        }
                    }
                }
            } else {
                $borrow->b_code_borrow = $request->b_code_borrow;
                $borrow->b_reader_id = $request->b_reader_id;
                $borrow->b_note = $request->b_note;

                if ($borrow->save()) {
                    Order::where('d_borrow_id', $id)->delete();
                    if (!empty($request->d_book_id)) {
                        $bookId = $request->d_book_id;
                        $number = $request->d_number;
                        $expiryDate = $request->d_expiry_date;
                        $note = $request->d_note;
                        $status = $request->d_status;
                        $forfeit = $request->d_forfeit;
                        foreach ($bookId as $key => $book) {
                            $order = new Order();
                            $order->d_borrow_id = $borrow->id;
                            $order->d_book_id = $book;
                            $order->d_reader_id = $request->b_reader_id;
                            $order->d_number = $number[$key];
                            $order->d_expiry_date = $expiryDate[$key];
                            $order->d_note = $note[$key];
                            $order->d_status = !empty($status[$key]) ? $status[$key] : 1;
                            $order->d_forfeit = $forfeit[$key];
                            $order->save();
                        }
                    }
                }
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }
}
