<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    const MEDIA_IMAGE_PATH = 'images/medias';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'title_hy',
        'title_en',
        'slug',
        'image',
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

}
