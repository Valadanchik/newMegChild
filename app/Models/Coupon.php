<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupon extends Model
{
    use HasFactory;

    const ALL_BOOKS = 'all_books';

    const SINGLE_BOOK = 'single';

    const EACH_BOOKS = 'each_books';

    protected $fillable = [
        'code',
        'price',
        'quantity',
        'type',
        'book_id',
    ];

    /**
     * @param $code
     * @return mixed
     */
    public static function updateCouponQuantity($code): mixed
    {
       return Coupon::where('code', $code)->update(['quantity' => DB::raw('quantity-1')]);
    }

}
