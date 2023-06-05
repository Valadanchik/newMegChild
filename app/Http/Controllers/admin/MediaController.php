<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\PostCategory;
use App\Traits\GeneralTrait;

class MediaController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias= PostCategory::all();
        return view('admin.media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            if($request->hasFile('file')){
                $imageName = self::imageUpload($request->file, PostCategory::MEDIA_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            $media = PostCategory::create($request->all());
            return redirect()->route('medias.edit', $media->id)->with('success', 'Medias created successfully');
        } catch (\Exception $e) {
            return redirect()->route('medias.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $medias, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $media = $medias::find($id);
        return view('admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, PostCategory $medias): \Illuminate\Http\RedirectResponse
    {
        try {
            if($request->hasFile('file')){
                $imageName = self::imageUpload($request->file, PostCategory::MEDIA_IMAGE_PATH);
                $request->merge(['image' => $imageName,]);
            }
            $media = $medias::find($request->id);
            $media->update($request->all());
            return redirect()->route('medias.edit', $media->id)->with('success', 'Medias updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('medias.index')->with('error', 'Something went wrong');
        }
    }

    /**
     * @param PostCategory $media
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PostCategory $media): \Illuminate\Http\RedirectResponse
    {
        try {
            $media->delete();
            return redirect()->route('medias.index')->with('success', 'Medias deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('medias.index')->with('error', 'Something went wrong');
        }
    }
}
