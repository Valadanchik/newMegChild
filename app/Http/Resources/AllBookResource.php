<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class AllBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name_hy" => $this->title_hy,
            "name_en" => $this->title_en,
            "short_summary_hy" => "",
            "short_summary_en" => "",
            "quote_hy" => $this->description_hy,
            "quote_en" => $this->description_en,
            "price" => $this->price,
            "original_name" => $this->title_en,
            "isbn" => $this->isbn,
            "print_date" => $this->published_date,
            "pages" => $this->page_count,
            "size" => $this->book_size_hy,
            "image" => URL::to('storage/' . $this->main_image),
            "in_stock" => $this->in_stock,
            "slug" => $this->slug,
            "status" => $this->status,
            "trailer_url" => $this->video_url,
            "category_name_hy" => $this->category->name_hy,
            "category_name_en" => $this->category->name_en,
            'authors' => AuthorsResource::collection($this->authors),
            "source" => "",
        ];
    }
}
