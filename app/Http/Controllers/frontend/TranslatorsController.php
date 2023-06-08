<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Translators;

class TranslatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function translators(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $translators = Translators::all();
        return view('translator/translators', compact('translators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view($slug): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $translator = Translators::with('books')->where('slug', $slug)->firstOrFail();
        return view('translator/index', compact('translator'));
    }

}
