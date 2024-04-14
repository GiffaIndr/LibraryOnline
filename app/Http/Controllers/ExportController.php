<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookExport;
use App\Exports\UserExport;
use App\Exports\CategoryExport;
use App\Exports\BorrowExport;

class ExportController extends Controller
{
    public function book()
    {
        return Excel::download(new BookExport, 'Book.xlsx');
    }
    public function user()
    {
        return Excel::download(new UserExport, 'user.xlsx');
    }
    public function category()
    {
        return Excel::download(new CategoryExport, 'Category.xlsx');
    }
    public function borrow()
    {
        return Excel::download(new BorrowExport, 'Borrow.xlsx');
    }
}
