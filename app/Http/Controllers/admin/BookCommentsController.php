<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductComments;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookCommentsController extends Controller
{

    use GeneralTrait;

    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $productComments = ProductComments::with('commentable', 'commentable.category')->orderBy('id', 'desc')->get();
        $accessorComments = ProductComments::with('commentable', 'commentable.category')->orderBy('id', 'desc')->get();

        $comments = $productComments->merge($accessorComments);

        return view('admin.book-comments.index', compact('comments'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function view(Request $request, $id)
    {
        $geParam = $request->input('immediately_activate');
        if ($geParam) {
            ProductComments::updateStatus(ProductComments::PUBLISHED, $id);
            Session::put('success_activate', 'Մեկնաբանությունը հաջողությամբ Հրապարակվել է');

            return $this->deleteUrlParameters($request->input());
        }

        $gerActivateMessage = Session::get('success_activate');
        Session::forget('success_activate');

        $comment = ProductComments::with('book')->findOrFail($id);
        return view('admin.book-comments.show', compact('comment', 'gerActivateMessage'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            ProductComments::updateStatus($request->is_active, $id);
            return redirect()->back()->with('success', 'Մեկնաբանությունը Հաջողությամբ թարմացվել է');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Comment not updated');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $getComment = ProductComments::findOrFail($id);
            $getComment->delete();
            return redirect()->back()->with('success', 'Մեկնաբանությունը հեռացվել է');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Մեկնաբանությունը չի հեռացվել');
        }
    }
}
