<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const API_LAST_POSTS_LIMIT = 6;

    const OTHERS_POSTS_LIMIT = 4;

    const POST_IMAGE_PATH = 'images/posts';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'post_category_id',
        'title_hy',
        'title_en',
        'description_hy',
        'description_en',
        'text_hy',
        'text_en',
        'image',
        'slug',
    ];

    public function postCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }
}
