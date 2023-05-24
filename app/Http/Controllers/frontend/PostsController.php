<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function articles(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::all();
        $postCategories = self::getPostCategories();
        return view('article/articles', compact('posts'), compact('postCategories'));
    }


    /**
     * Display the specified resource.
     */
    public function view(Post $post, $slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $otherPosts = self::otherPosts($slug);
        $post = $post::where('slug', $slug)
            ->firstOrFail();

        return view('article/index', compact('post'), compact('otherPosts'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function medias($slug): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $postCategoryID = self::getPostCategoryId($slug);
        $mediaPosts = Post::where('post_category_id', $postCategoryID)->get();

        return view('article/medias', compact('mediaPosts'));
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public static function getPostCategories(): \Illuminate\Database\Eloquent\Collection|array
    {
        return PostCategory::with('post')->get();
    }

    /**
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public static function getPostCategoryId($slug): \Illuminate\Database\Eloquent\Collection|array
    {
        return  PostCategory::where('slug', $slug)->firstOrFail()->id;
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
