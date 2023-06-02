<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translators extends Model
{
    use HasFactory;

    const TRANSLATOR_IMAGE_PATH = 'images/translators';

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
    public function Translators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Books::class, 'book_translators_pivot', 'translator_id', 'book_id')->withTimestamps();
    }
}
