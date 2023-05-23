<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'book_id',
    ];

    public function book(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Books::class);
    }

}
