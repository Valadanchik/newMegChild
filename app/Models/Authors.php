<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    const AUTHOR_IMAGE_PATH = 'images/authors';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name_hy',
        'name_en',
        'about_hy',
        'about_en',
        'slug',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Books::class, 'book_authors_pivot', 'author_id', 'book_id')->withTimestamps();
    }
}
