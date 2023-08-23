<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function articles(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $postCategories = self::getPostCategories();
        return view('article/articles', compact('posts'), compact('postCategories'));
    }

    /**
     * Display the specified resource.
     */
    public function view(Post $post, $slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $otherPosts = self::otherPosts($slug);
        $post = $post::where('slug', $slug)->firstOrFail();
        $shareUrl = LaravelLocalization::localizeUrl('/article/'. $post['slug']);

        return view('article/index', compact('post'), compact('otherPosts', 'shareUrl'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function medias($slug): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $postCategoryID = self::getPostCategoryId($slug);
        $postCategories = self::getPostCategories();
        $mediaPosts = Post::where('post_category_id', $postCategoryID)->get();

        return view('article/medias', compact('mediaPosts', 'postCategories'));
    }

    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function mediaArticles(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $postCategories = self::getPostCategories();
        $mediaPosts = Post::where('post_category_id', '!=', NULL)->get();

        return view('article/medias', compact('mediaPosts', 'postCategories'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public static function getPostCategories(): \Illuminate\Database\Eloquent\Collection|array
    {
        return PostCategory::has('post')->orderBy('id', 'DESC')->get();
    }

    /**
     * @param $slug
     * @return int
     */
    public static function getPostCategoryId($slug): int
    {
        return PostCategory::has('post')->where('slug', $slug)->firstOrFail()->id;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function otherPosts($id): mixed
    {
        return Post::where('slug', '!=', $id)
            ->inRandomOrder()
            ->limit(Post::OTHERS_POSTS_LIMIT)
            ->get();
    }
}
