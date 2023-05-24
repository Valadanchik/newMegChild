<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function articles(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        dd(self::getPostCategories());
        $posts = Post::all();
        $postCategories = self::getPostCategories();
        return view('article/articles', compact('posts'), compact('postCategories'));
    }

    public static function getPostCategories(): \Illuminate\Database\Eloquent\Collection|array
    {
       return PostCategory::with('post')->get();
//        dd($categories);
    }

    /**
     * Display the specified resource.
     */
    public function view(Post $post, $slug): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $otherPosts = $this->otherPosts($slug);
        $post = $post::where('slug', $slug)
            ->firstOrFail();

        return view('article/index', compact('post'), compact('otherPosts'));
    }

    /**
     * @param $id
     * @return mixed
     */

    public function otherPosts($id): mixed
    {
        return Post::where('slug', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }
}
