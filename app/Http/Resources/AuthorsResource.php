<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class AuthorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name_hy' => $this->name_hy,
            'name_am' => $this->name_hy,
            'name_en' => $this->name_en,
            "image" => URL::to('storage/' . $this->image),
            "description_en" => $this->about_en,
            "description_hy" => $this->about_hy,
        ];
    }
}
