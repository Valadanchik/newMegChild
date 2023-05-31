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

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_book_pivote', 'book_id', 'order_id')->withPivot('id', 'quantity', 'price', 'status');
    }
}
