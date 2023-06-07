<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Authors;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function authors(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $authors = Authors::all();
        return view('author/authors', compact('authors'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function view($slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $author = Authors::with('books')->where('slug', $slug)->firstOrFail();
        return view('author/index', compact('author'));
    }

}
