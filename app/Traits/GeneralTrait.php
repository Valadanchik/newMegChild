<?php

namespace App\Traits;

use \Illuminate\Database\Eloquent\Collection;

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
            $imageName = time() . '.' . $file->extension();
            $file->storeAs('public/' . $path, $imageName);
            return $path . '/' . $imageName;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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

}
