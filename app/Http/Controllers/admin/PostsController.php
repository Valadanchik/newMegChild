<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Traits\GeneralTrait;

class PostsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::with('postCategory')->orderBy('id', 'desc')->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $postCategories = PostCategory::orderBy('id', 'desc')->get();

        return view('admin.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Post::POST_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            $post = Post::create($request->all());
            return redirect()->route('posts.edit', $post->id)->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            return redirect()->route('posts.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $post = $posts::findOrFail($id);
        $postCategories = PostCategory::all();

        return view('admin.post.edit', compact('post', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $posts): \Illuminate\Http\RedirectResponse
    {
        try {
            $post = $posts::findOrFail($request->id);
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Post::POST_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            $post->update($request->all());
            return redirect()->route('posts.edit', $request->id)->with('success', 'Post updated successfully');
        } catch (\Exception $th) {
            return redirect()->route('posts.edit', $request->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $post = $posts::findOrFail($id);
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $th) {
            return redirect()->route('posts.index')->with('error', 'Something went wrong');
        }

    }
}
