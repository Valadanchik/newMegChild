<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function articles(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::all();

        return view('article/articles', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function view(Post $post, $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $otherPosts = $this->otherPosts($id);
        $post = $post::where('id', $id)
            ->firstOrFail();

        return view('article/index', compact('post'), compact('otherPosts'));
    }

    /**
     * @param $id
     * @return mixed
     */

    public function otherPosts($id): mixed
    {
        return Post::where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

}
