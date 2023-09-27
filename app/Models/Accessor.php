<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessor extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const ACCESSOR_IMAGE_PATH = 'images/accessors';

    protected $fillable = [
        'category_id',
        'title_hy',
        'description_hy',
        'price',
        'main_image',
        'slug',
        'in_stock',
        'isbn',
        'age',
        'status',
    ];

    /**
     * @param $accessorId
     * @return mixed
     */
    public static function constructOtherAccessorsQuery($accessorId): mixed
    {
        return Accessor::where('id', '!=', $accessorId)
            ->where('status', Accessor::ACTIVE)
            ->inRandomOrder()
            ->limit(4);
    }

    /**
     * @param $sessionAccessorId
     * @return void
     */
    public static function changeInStockAfterOrder($accessorsId)
    {
        $getAccessorsId = array_keys($accessorsId);
        $accessors = Accessor::whereIn('id', $getAccessorsId)->get();
        foreach ($accessors as $accessor) {
            $oldInStock = $accessor->in_stock;
            $newInStock = (int)$accessorsId[$accessor->id];
            $quantityToSubtract = $oldInStock - $newInStock;
            $accessor->in_stock = $quantityToSubtract;
            $accessor->save();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Books::class, 'accessor_books', 'accessor_id', 'book_id');
    }

    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(ProductComments::class, 'commentable');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product_pivote', 'book_id', 'order_id')
            ->withPivot('id', 'quantity', 'price', 'status');
    }
}
