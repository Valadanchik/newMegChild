<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessorRequest;
use App\Http\Requests\UpdateAccessorRequest;
use App\Models\Accessor;
use App\Models\Categories;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AccessorController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessors = Accessor::all();
        return view('admin.accessor.index', compact('accessors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::where('type', Categories::TYPE_ACCESSOR)->get();
        return view('admin.accessor.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccessorRequest $request, Accessor $accessor)
    {
        DB::beginTransaction();

        try {
            $accessorImages = [];
            if ($request->hasFile('file')) {
                $imageName = self::imageUpload($request->file, Accessor::ACCESSOR_IMAGE_PATH);
                $request->merge(['main_image' => $imageName]);

                if ($request->hasFile('images')) {
                    $filesName = self::imagesUpload($request->images, Accessor::ACCESSOR_IMAGE_PATH);
                    $accessorImages = self::changeArrayKeys('image', $filesName);
                }
            }

            $accessorCreate = $accessor::create($request->all());

            if (count($accessorImages)) $accessorCreate->images()->createMany($accessorImages);

            DB::commit();

            return redirect()->route('accessors.create')->with('success', 'Accessor created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('accessors.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $accessor = Accessor::with('images')->findOrFail($id);
        $categories = Categories::where('type', Categories::TYPE_ACCESSOR)->get();
        $imagesPathAndId = $this->getImagePathAndId($accessor->images);

        return view('admin.accessor.edit', compact('accessor', 'categories', 'imagesPathAndId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccessorRequest $request, Accessor $accessor)
    {
        DB::beginTransaction();
        try {
            $accessorImages = [];
            $accessor = $accessor::with('images')->findOrFail($request->id);

            if ($request->hasFile('file')) {
                $imageName = self::imageUpload($request->file, Accessor::ACCESSOR_IMAGE_PATH);
                $request->merge(['main_image' => $imageName]);
            }
            if ($request->hasFile('images')) {
                $filesName = self::imagesUpload($request->images, Accessor::ACCESSOR_IMAGE_PATH);
                $accessorImages = self::changeArrayKeys('image', $filesName);
            }

            $accessor->update($request->all());
            if (count($accessorImages)) $accessor->images()->createMany($accessorImages);

            DB::commit();

            return redirect()->route('accessors.edit', $request->id)->with('success', 'Accessor updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('accessors.edit', $request->id)->with('error', 'Something went wrong');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $accessor = Accessor::findOrFail($id);
        $accessor->delete();
        return redirect()->route('accessors.index')->with('success', 'Accessor deleted successfully');
    }
}
