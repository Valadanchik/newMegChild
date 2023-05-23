<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_hy',
        'name_en',
        'image',
    ];

    public function books(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Books::class, 'book_authors_pivot', 'author_id', 'book_id');
    }
}
