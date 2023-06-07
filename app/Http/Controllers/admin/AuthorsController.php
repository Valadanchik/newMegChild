<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Authors;
use App\Traits\GeneralTrait;

class AuthorsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $authors = Authors::all();
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Authors::AUTHOR_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            Authors::create($request->all());
            return redirect()->route('authors.create')->with('success', 'Author created successfully');
        } catch (\Exception $e) {
            return redirect()->route('authors.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Authors $authors, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $author = $authors::findOrFail($id);
        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Authors $authors): \Illuminate\Http\RedirectResponse
    {
        try {
            $author = $authors::findOrFail($request->id);
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Authors::AUTHOR_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            $author->update($request->all());
            return redirect()->route('authors.edit', $request->id)->with('success', 'Author updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('authors.edit', $request->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Authors $authors, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $author = $authors::findOrFail($id);
            $author->delete();
            return redirect()->route('authors.index')->with('success', 'Author deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('authors.index')->with('error', 'Something went wrong');
        }
    }
}
