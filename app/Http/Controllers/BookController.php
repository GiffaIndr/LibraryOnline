<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('user.dashboard', compact('books'));
    }


    public function bookList()
    {
        $categories = Category::all();
        $books = Book::all();
        return view('admin.book', compact('books', 'categories'));
    }

    
    public function review($id)
    {
        $books = Book::where('id', $id)->get();
        return view('user.review', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required',
            'synopsis' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'release' => 'required',
        ]);
        $image = $request->file('cover');
        $imgName = time() . rand();
        if(!file_exists(public_path('/assets/img/' . $image->getClientOriginalName()))){
            $destinationPath = public_path('/assets/img/');
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        Book::create([
            'title' => $request->title,
            'cover' => $uploaded,
            'synopsis' => $request->synopsis,
            'writer' => $request->writer,
            'publisher' => $request->publisher,
            'category' => $request->category,
            'release' => $request->release,
            'slug' => Str::slug($request->title),
            'available' => true
        ]);
        return redirect()->back()->with('success', 'sukses menambah buku!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required',
            'synopsis' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'release' => 'required',
        ]);
        $image = $request->file('cover');
        $imgName = time() . rand();
        if(!file_exists(public_path('/assets/img/' . $image->getClientOriginalName()))){
            $destinationPath = public_path('/assets/img/');
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
        }else{
            $uploaded = $image->getClientOriginalName();
        }
        Book::where('id', $id)->update([
            'title' => $request->title,
            'cover' => $uploaded,
            'synopsis' => $request->synopsis,
            'writer' => $request->writer,
            'publisher' => $request->publisher,
            'category' => $request->category,
            'release' => $request->release,
            'slug' => Str::slug($request->title),
            'available' => true
        ]);
        return redirect()->back()->with('success', 'sukses edit buku!');
    }

    
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect()->back()->with('success', 'sukses hapus buku');
    }
}
