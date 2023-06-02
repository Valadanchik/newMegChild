<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    const HOME_PAGE_BOOKS_COUNT = 4;

    const BOOK_IMAGE_PATH = 'images/books';

    protected $fillable = [
        'title_hy',
        'title_en',
        'text_hy',
        'text_en',
        'description_hy',
        'description_en',
        'book_size_hy',
        'book_size_en',
        'video_url',
        'slug',
        'price',
        'word_count',
        'page_count',
        'font_size',
        'isbn',
        'in_stock',
        'main_image',
        'category_id',
        'published_date',
    ];

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function changeInStockAfterOrder(): void
    {
        $card = session()->get('cart');
        if(count($card)) {
            $sessionProductsId = array_keys($card);
            $books = Books::whereIn('id', $sessionProductsId)->get();

            foreach ($books as $book) {
                $oldInStock = $book->in_stock;
                $newInStock = (int) $card[$book->id];
                $quantityToSubtract = $oldInStock - $newInStock;
                $book->in_stock = $quantityToSubtract;
                $book->save();
            }
        }
        session()->forget('cart');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function authors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Authors::class, 'book_authors_pivot', 'book_id', 'author_id')->withTimestamps();
    }

    public function translators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Translators::class, 'book_translators_pivot', 'book_id', 'translator_id')->withTimestamps();
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Images::class, 'book_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_book_pivote', 'book_id', 'order_id')->withPivot('id', 'quantity', 'price', 'status');
    }
}
