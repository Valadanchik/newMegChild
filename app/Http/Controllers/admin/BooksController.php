<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Translators;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Authors::all();
        $translators = Translators::all();
        $categories = Categories::all();

        return view('admin.book.create', compact('authors', 'translators', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request, Books $books)
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('file')) {
                $imageName = self::imageUpload($request->file, Books::BOOK_IMAGE_PATH);
                $request->merge(['main_image' => $imageName,]);
            }

            $bookCreate = $books::create($request->all());
            $bookCreate->authors()->attach($request->authors);
            $bookCreate->translators()->attach($request->translators);
            DB::commit();

            return redirect()->route('books.create')->with('success', 'Book created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('books.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $books, $id)
    {
        $authors = Authors::all();
        $translators = Translators::all();
        $categories = Categories::all();
        $book = $books::with(['category', 'authors', 'translators'])->findOrFail($id);
        $translatorsForSelected = self::filterData($book->translators);
        $authorsForSelected = self::filterData($book->authors);

        return view('admin.book.edit', compact('book', 'categories', 'authors', 'translators', 'translatorsForSelected', 'authorsForSelected'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Books $books)
    {
        DB::beginTransaction();
        try {
            $book = $books::findOrFail($request->id);

            if ($request->hasFile('file')) {
                $imageName = self::imageUpload($request->file, Books::BOOK_IMAGE_PATH);
                $request->merge(['main_image' => $imageName,]);
            }

            $book->update($request->all());
            $book->authors()->sync($request->authors);
            $book->translators()->sync($request->translators);
            DB::commit();

            return redirect()->route('books.edit', $request->id)->with('success', 'Book updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('books.edit', $request->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books, $id)
    {
        $model = $books::find($id);

        if (!$model) {
            return redirect()->back()->with('error', 'Model not found.');
        }

        $model->delete();

        return redirect()->back()->with('success', 'Model deleted successfully.');
    }
}
