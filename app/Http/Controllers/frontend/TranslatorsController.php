<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Translators;
use Illuminate\Http\Request;

class TranslatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function translators()
    {
        $translators = Translators::all();

        return view('translator/translators', compact('translators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view()
    {
        //
    }

}
