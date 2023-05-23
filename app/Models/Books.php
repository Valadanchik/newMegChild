<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    const HOME_PAGE_BOOKS_COUNT = 4;
    protected $fillable = [
        'title ',
        'word_count',
        'font_size',
        'category_id',
        'author_id',
        'translator_id',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function authors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Authors::class, 'book_authors_pivot', 'book_id', 'author_id');
    }

    public function translators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Translators::class, 'book_translators_pivot', 'book_id', 'translator_id');
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Images::class, 'book_id', 'id');
    }
}
