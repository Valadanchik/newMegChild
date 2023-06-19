<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookComments extends Model
{
    use HasFactory, SoftDeletes;

    const PUBLISHED = 1;
    const NOT_PUBLISHED = 0;

    protected $fillable = [
        'book_id',
        'full_name',
        'email',
        'comment',
    ];

    /**
     * @param $status
     * @param $id
     * @return void
     */
    public static function updateStatus($status, $id): void
    {
        $getComment = BookComments::find($id);
        $getComment->is_active = $status;
        $getComment->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Books::class);
    }
}
