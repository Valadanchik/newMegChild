<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = [
            'categories' => self::getHomeCategories(),
            'authors' => self::getHomeAuthors(),
            'posts' => self::getHomePosts(),
            'books' => self::getHomeBooks(),
            'lastParentBook' => self::getHomeLastParentBook(),
        ];

        return view('index', compact('data'));
    }

    /**
     * @return mixed
     */
    public static function getHomeCategories()
    {
        return Categories::whereIn('id', [Categories::AYB, Categories::BEN, Categories::GIM, Categories::DA])->get();
    }

    /**
     * @return mixed
     */
    public static function getHomeAuthors()
    {
        return Authors::orderBy('id', 'DESC')->limit(4)->get();
    }

    /**
     * @return mixed
     */
    public static function getHomePosts()
    {
        return Post::orderBy('id', 'DESC')->limit(4)->get();
    }

    /**
     * @return mixed
     */
    public static function getHomeBooks(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Books::with('category')->with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('books')
                    ->whereIn('category_id', [Categories::AYB, Categories::BEN, Categories::GIM, Categories::DA])
                    ->groupBy('category_id');
            })
            ->take(Books::HOME_PAGE_BOOKS_COUNT)
            ->get();
    }

    /**
     * @return mixed
     */
    public static function getHomeLastParentBook()
    {
        return Books::with('category')->with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->firstWhere('category_id', Categories::PARENT);
    }
}
