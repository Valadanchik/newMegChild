<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SetSettingDataServiceMiddleware extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {



//        dd(session()->all());
//        if (!session('settings')) {
////            dd(4545);
//            $allSettings = DB::table('settings')->get();
//            $sessionData = [];
//
//            foreach ($allSettings as $setting) {
//                $sessionData[$setting->slug] = $setting->value;
//            }
//            session()->put('settings', $sessionData);
//        }
//        dd(session()->all());
    }

        /**
         * Bootstrap services.
         */
        public function boot(): void
        {
            //
        }
    }
