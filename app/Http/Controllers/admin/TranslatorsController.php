<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use App\Models\Translators;
use App\Traits\GeneralTrait;

class TranslatorsController extends Controller
{

    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $translators = Translators::all();
        return view('admin.translator.index', compact('translators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.translator.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTranslatorRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Translators::TRANSLATOR_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            Translators::create($request->all());
            return redirect()->route('translators.create')->with('success', 'Aranslator created successfully');
        } catch (\Exception $e) {
            return redirect()->route('translators.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Translators $translators)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Translators $translators, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $translator = $translators::find($id);
        return view('admin.translator.edit', compact('translator'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTranslatorRequest $request, Translators $translators): \Illuminate\Http\RedirectResponse
    {
        try {
            $translator = $translators::find($request->id);
            if ($request->file('file')) {
                $imageName = self::imageUpload($request->file('file'), Translators::TRANSLATOR_IMAGE_PATH);
                $request->merge(['image' => $imageName]);
            }

            $translator->update($request->all());
            return redirect()->route('translators.edit', $request->id)->with('success', 'Translator updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('translators.edit', $request->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translators $translators, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $translator = $translators::find($id);
            $translator->delete();
            return redirect()->route('translators.index')->with('success', 'Translator deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('translators.index')->with('error', 'Something went wrong');
        }
    }
}
