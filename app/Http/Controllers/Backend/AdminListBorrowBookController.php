<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class AdminListBorrowBookController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'ListBorrowBook',
        ]);
    }
    //
    public function listBorrowBook(Request $request)
    {

    }
}
