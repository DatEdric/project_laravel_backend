<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reader;
use App\Models\Book;
use App\Models\ImportBook;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Home',
        ]);
    }

    public function index()
    {
        $amountReader = Reader::count('id');
        $amountBook = ImportBook::sum('ib_amount');
        $amountLiquidated = Book::sum('b_amount_liquidated');
        $amountOrder = Order::whereIn('d_status', [1, 3, 4])->sum('d_number');
        $amountOrderLiquidated = Order::whereIn('d_status', [3, 4])->sum('d_number');
        $totalBookBorrowing = Order::where('d_status', 1)->sum('d_number');
        $totalBook = $amountBook - ($amountLiquidated + $amountOrder);
        $totalBookLiquidated = $amountLiquidated + $amountOrderLiquidated;

        $newImportBook = ImportBook::with('book:id,b_name')->orderByDesc('created_at')->limit(30)->get();
        $readersViolated = Order::with('reader:id,r_name', 'book:id,b_name')->whereIn('d_status', [3,4])->orWhere('d_expiry_date', '<', date('Y-m-d'))->orderByDesc('id')->limit(30)->get();
        $readersBorrowing = Order::with('reader:id,r_name', 'book:id,b_name')->where('d_status', 1)->orWhere('d_expiry_date', '>', date('Y-m-d'))->orderByDesc('id')->limit(30)->get();
        $viewData = [
            'amountReader' => $amountReader,
            'totalBook' => $totalBook,
            'totalBookLiquidated' => $totalBookLiquidated,
            'totalBookBorrowing' => $totalBookBorrowing,
            'newImportBook' => $newImportBook,
            'readersViolated' => $readersViolated,
            'readersBorrowing' => $readersBorrowing
        ];
        //dd($viewData);
        return view('backend.dashboard', $viewData);
    }

    public function checkBook(Request $request)
    {
        if ($request->ajax()) {
            $number_book = $request->number_book > 0 ? $request->number_book : 0;
            $book_id = $request->id_book;

            $amountBook = ImportBook::where('ib_books_id', $book_id)->sum('ib_amount');
            $amountLiquidated = Book::where('id', $book_id)->sum('b_amount_liquidated');
            $amountOrder = Order::where('d_book_id', $book_id)->whereIn('d_status', [1, 3, 4])->sum('d_number');
            $amountOrderLiquidated = Order::where('d_book_id', $book_id)->whereIn('d_status', [3, 4])->sum('d_number');
            $totalBookBorrowing = Order::where('d_book_id', $book_id)->where('d_status', 1)->sum('d_number');
            $totalBook = $amountBook > 0 ? $amountBook - ($amountLiquidated + $amountOrder + $amountOrderLiquidated + $totalBookBorrowing) : 0;

            if ($number_book > $totalBook) {
                return response([
                    'code' => 405,
                    'total_book' => $totalBook,
                    'message' => 'Số lượng sách trong kho không đủ để mượn : '. $totalBook
                ]);
            } else {
                return response([
                    'code' => 200,
                ]);
            }

            return response([
                'code' => 405,
                'message' => 'Đã xảy ra lỗi'
            ]);
        }
    }
}
