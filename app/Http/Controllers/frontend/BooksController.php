<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Books;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function books(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {

        $books = Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }])->get();

        return view('book/books', compact('books'));
    }

    /**
     * Display the specified resource.
     */
    public function view(Books $books, $slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $book = $books::with(['authors', 'category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('book/index', compact('book'));
    }

}
