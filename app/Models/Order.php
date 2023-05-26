<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PAYMENT_METHOD_BANK = 1;
    const PAYMENT_METHOD_IDRAM = 2;
    const PAYMENT_METHOD_TELCELL = 3;


    const PAYMENT_METHODS = [
        self::PAYMENT_METHOD_BANK,
        self::PAYMENT_METHOD_IDRAM,
        self::PAYMENT_METHOD_TELCELL,
//        self::PAYMENT_METHOD_GIFT_CARD,   #TODO: uncomment when gift card payment method is ready
    ];

    const STATUS_NEW = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_FAILED = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_RETURNED = 6;
    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_PROCESSING,
        self::STATUS_COMPLETED,
        self::STATUS_FAILED,
        self::STATUS_DELIVERED,
        self::STATUS_RETURNED,
    ];

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'street',
        'house',
        'apartment',
        'entrance',
        'floor',
        'comment',
        'payment_method',
        'country_id',
        'region_id',
        'user_id',
        'total_price',
        'total_price_with_discount',
        'payment_callback',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function books()
    {
        return $this->belongsToMany(Books::class,'order_book_pivote', 'order_id', 'book_id')
            ->withPivot('id', 'quantity', 'price', 'status')
            ->withTimestamps();
    }

}
