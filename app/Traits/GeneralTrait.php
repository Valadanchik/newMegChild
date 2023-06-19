<?php

namespace App\Traits;

use App\Models\Images;
use \Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\NoReturn;

trait GeneralTrait
{

    /**
     * @param $file
     * @param $path
     * @return string
     */
    public static function imageUpload($file, $path): string
    {
        try {
            $imageName = time() . rand(1, 50) . '.' . $file->extension();
            $file->storeAs('public/' . $path, $imageName);
            return $path . '/' . $imageName;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $files
     * @param $path
     * @return array
     */
    public function imagesUpload($files, $path): array
    {
        foreach ($files as $file) {
            $filesName[] = self::imageUpload($file, $path);
        }
        return $filesName ?? [];
    }

    /**
     * @param $keyName
     * @param array $array
     * @return array
     */
    public function changeArrayKeys($keyName, array $array = []): array
    {
        return array_map(function ($item) use ($keyName)  {
            return [$keyName => $item];
        }, $array);
    }

    /**
     * @param $data
     * @return array
     */
    public static function filterData($data): array
    {
        if ($data instanceof Collection) {
            $data = $data->map(function ($item) {
                return $item->id;
            });

            return $data->toArray();
        }
        return [];
    }

    /**
     * @param $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function deleteUrlParameters($params): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $urlWithoutParams = url()->current().http_build_query(request()->except(array_keys($params)));

        return redirect($urlWithoutParams);
    }

}
