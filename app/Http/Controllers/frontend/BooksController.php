<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchFilterResource;
use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function books(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $slug = null;

        $categories = Categories::all();
        $books = Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }])->get();

        return view('book/books', compact('books', 'categories', 'slug'));
    }

    /**
     * Display a listing of the resource.
     */
    public function searchBooks(Request $request)
    {
        $books = [];
        if ($request->search != '') {
            $search = trim($request->search);
            $books = Books::with(['authors' => function ($query) {
                $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
            }])->where(function ($query) use ($search) {
                $query->where('title_en', 'like', '%' . $search . '%')
                    ->orWhere('title_hy', 'like', '%' . $search . '%')
                    ->orWhere('text_en', 'like', '%' . $search . '%')
                    ->orWhere('text_hy', 'like', '%' . $search . '%')
                    ->orWhere('description_en', 'like', '%' . $search . '%')
                    ->orWhere('description_hy', 'like', '%' . $search . '%');
            })
                ->get();
        }

        $data = SearchFilterResource::collection($books);

        return response()->json($data);
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

    /**
     * Display the specified resource.
     */
    public function booksByCategory($slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Categories::all();
        $books = Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }])
            ->where('category_id', Categories::bookCategoryId($slug))
            ->get();

        return view('book/books', compact('books', 'categories', 'slug'));
    }

}
