<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $books = Book::with(['categories:id,c_name', 'publishingCompany:id,pc_name', 'authorBook', 'amount']);

        if ($request->b_name) {
            $keyword = $request->b_name;
            $books->where('b_name', 'like', '%' . $request->b_name . '%')->orWhereIn('b_categories_id', function ($query) use ($keyword) {
                $query->select('id')->from('categories')->where('c_name', 'like', '%' . $keyword . '%');
            });
            $authorIds = Author::where('at_name', 'like', '%' . $keyword . '%')->pluck('id')->toArray();
            $books->orWhereIn('id', function ($query) use ($authorIds) {
                $query->select('book_id')->from('author_book')->whereIn('author_id', $authorIds);
            });
        }

        $books = $books->orderByDesc('id')->paginate(12);

        return view('page.home.index', compact('books'));
    }

    public function detail($slug, $id)
    {

        $book = Book::with('categories', 'publishingCompany', 'amount', 'authorBook')->find($id);

        if (!$book) {
            return redirect()->back();
        }

        return view('page.home.detail', compact('book'));
    }
}
