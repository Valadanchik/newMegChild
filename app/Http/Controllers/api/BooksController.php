<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllBookResource;
use App\Http\Resources\BookResource;
use App\Models\Books;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getLastBooks(): \Illuminate\Http\JsonResponse
    {
        $getBooks = Books::with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }])
            ->where('status', Books::ACTIVE)
            ->orderBy('id', 'DESC')
            ->limit(Books::API_LAST_BOOKS_LIMIT)
            ->get();

        $data = BookResource::collection($getBooks);

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBooks(): \Illuminate\Http\JsonResponse
    {
        $getBooks = Books::with(['authors', 'category' => function ($query) {
            $query->select('categories.id', 'categories.name_hy', 'categories.name_en');
        }])
            ->where('status', Books::ACTIVE)
            ->orderBy('id', 'DESC')
            ->get();

        $data = AllBookResource::collection($getBooks);

        return response()->json($data);
    }
}
