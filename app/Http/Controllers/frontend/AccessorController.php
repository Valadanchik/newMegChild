<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Accessor;
use App\Traits\GeneralTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AccessorController extends Controller
{
    use GeneralTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function accessors(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $accessors = Accessor::where('status', Accessor::ACTIVE)->get();
        return view('accessor.accessors', compact('accessors'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function view($slug): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $accessor = Accessor::with(['category', 'images'])->where(['status' => Accessor::ACTIVE, 'slug' => $slug])->first();

        $shareUrl = LaravelLocalization::localizeUrl('/accessor/' . $accessor['slug']);
//        $otherAccessors = [];

        $otherAccessors = $this->otherBooks($accessor->id, $accessor->category_id);

//        dd($accessor);
        return view('accessor.index', compact('accessor', 'shareUrl', 'otherAccessors'));
    }

    /**
     * @param $accessorId
     * @param $categoryId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function otherBooks($accessorId, $categoryId): \Illuminate\Database\Eloquent\Collection|array
    {
        $otherBooks = Accessor::constructOtherAccessorsQuery($accessorId)->where('category_id', '=', $categoryId)->get();

        if (!count($otherBooks)) {
            $otherBooks = Accessor::constructOtherAccessorsQuery($accessorId)->where('category_id', '<>', $categoryId)->get();
        }

        return $otherBooks;
    }


}
