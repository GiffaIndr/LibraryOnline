<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);
        Category::create([
            'category' => $request->category
        ]);
        return redirect()->back()->with('success', 'sukses tambah kategori!');
    }


    
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'sukses hapus kategori!');
    }
}
