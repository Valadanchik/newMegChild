<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $allSettings = Settings::all();

        return view('admin.settings.index', compact('allSettings'));
    }

    /**
     * @param UpdateSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingsRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $dataArray = $request->collect()->except(['_token', '_method']);
            $dataArray->map(function ($item, $key) {
                return Settings::where('slug', $key)->update(['value' => $item]);
            });

            Cache::forget('settings');
            return redirect()->back()->with('success', 'Settings updated successfully');
        }
        catch (\Exception $e) {
             return redirect()->back()->with('error', 'Something went wrong');
        }
    }

}
