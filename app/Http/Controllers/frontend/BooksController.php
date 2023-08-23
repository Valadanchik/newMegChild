<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchFilterResource;
use App\Models\BookComments;
use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        }])
            ->where('status', Books::ACTIVE)
            ->orderBy('id', 'DESC')
            ->get();

        return view('book/books', compact('books', 'categories', 'slug'));
    }

    /**
     * Display a listing of the resource.
     */
    public function searchBooks(Request $request): \Illuminate\Http\JsonResponse
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
                ->where('status', Books::ACTIVE)
                ->orderBy('id', 'DESC')
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
        $book = $books::with(['authors', 'translators', 'category'])
            ->with(['comments' => function ($query) {
                $query->orderBy('book_comments.created_at', 'desc')
                    ->where('book_comments.is_active', '=', BookComments::PUBLISHED);
//                    ->limit(4);
            }])
            ->with(['images' => function ($query) {
                $query->orderBy('images.order', 'ASC');
            }])
            ->where('slug', $slug)
            ->where('status', Books::ACTIVE)
            ->firstOrFail();

        $shareUrl = LaravelLocalization::localizeUrl('/book/' . $book['slug']);

        $otherBooks = $this->otherBooks($book->id, $book->category_id);

        return view('book/index', compact('book', 'shareUrl', 'otherBooks',));
    }

    /**
     * @param $bookId
     * @param $categoryId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function otherBooks($bookId, $categoryId): \Illuminate\Database\Eloquent\Collection|array
    {
        $otherBooks = Books::constructOtherBooksQuery($bookId)->where('category_id', '=', $categoryId)->get();

        if (!count($otherBooks)) {
            $otherBooks = Books::constructOtherBooksQuery($bookId)->where('category_id', '<>', $categoryId)->get();
        }

        return $otherBooks;
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
            ->where('category_id', Categories::bookCategorySlug($slug))
            ->where('status', Books::ACTIVE)
            ->get();

        return view('book/books', compact('books', 'categories', 'slug'));
    }

}
