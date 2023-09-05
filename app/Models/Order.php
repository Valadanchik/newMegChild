<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    const STATUS_RETURNED = 5;

    const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_PROCESSING,
        self::STATUS_COMPLETED,
        self::STATUS_FAILED,
        self::STATUS_RETURNED,
    ];

    protected $fillable = [
        'order_payment_id',
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

    //on create
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_payment_id = rand(1000000, 9999999) . time();
            $order->status = self::STATUS_NEW;
        });
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function books(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Books::class,'order_product_pivote', 'order_id', 'product_id')
            ->withPivot('id', 'quantity', 'price', 'status', 'product_type')
            ->withTimestamps();
    }

    public function accessors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Accessor::class,'order_product_pivote', 'order_id', 'product_id')
            ->withPivot('id', 'quantity', 'price', 'status', 'product_type')
            ->withTimestamps();
    }
}
