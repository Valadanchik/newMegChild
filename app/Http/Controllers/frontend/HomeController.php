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
     * HomeController constructor.
     * @param Categories $categories
     * @param Authors $authors
     * @param Post $posts
     * @param Books $books
     */
    public function __construct(
        public Categories $categories,
        public Authors    $authors,
        public Post       $posts,
        public Books      $books
    )
    {

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = [
            'categories' => $this->getHomeCategories(),
            'authors' => $this->getHomeAuthors(),
            'posts' => $this->getHomePosts(),
            'books' => $this->getHomeBooks(),
            'lastParentBook' => $this->getHomeLastParentBook(),
        ];

        return view('index', compact('data'));
    }

    /**
     * @return mixed
     */
    public function getHomeCategories(): mixed
    {
        return $this->categories->whereIn('id', [Categories::AYB, Categories::BEN, Categories::GIM, Categories::DA])->get();
    }

    /**
     * @return mixed
     */
    public function getHomeAuthors(): mixed
    {
        return $this->authors->orderBy('id', 'DESC')->limit(4)->get();
    }

    /**
     * @return mixed
     */
    public function getHomePosts(): mixed
    {
        return $this->posts->orderBy('id', 'DESC')->limit(4)->get();
    }

    /**
     * @return mixed
     */
    public function getHomeBooks(): mixed
    {
        return $this->books->with('category')
//            ->with(['authors' => function ($query) {
//            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
//        }, 'translators' => function ($query) {
//            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
//        }])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('books')
                    ->whereIn('category_id', [Categories::AYB, Categories::BEN, Categories::GIM, Categories::DA])
                    ->groupBy('category_id');
            })
            ->where('status', Books::ACTIVE)
            ->take(Books::HOME_PAGE_BOOKS_COUNT)
            ->orderBy('category_id', 'ASC')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getHomeLastParentBook(): mixed
    {
        return $this->books->with('category')->with(['authors' => function ($query) {
            $query->select('authors.id', 'authors.name_hy', 'authors.name_en');
        }, 'translators' => function ($query) {
            $query->select('translators.id', 'translators.name_hy', 'translators.name_en');
        }])
            ->firstWhere('category_id', Categories::PARENT);
    }
}
