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
        'company',
        'comment',
        'payment_method',
        'country_id',
        'region_id',
        'region',
        'user_id',
        'total_price',
        'total_price_with_discount',
        'payment_callback',
        'order_text',
        'postal_code',
        'status',
    ];

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function changeInStock(): void
    {
        $cart = session()->get('cart');

        $sessionBookId = [];
        $sessionAccessorId = [];
        foreach ($cart as $cartValue) {
            match ($cartValue['product_type']) {
                Categories::TYPE_BOOK => $sessionBookId[$cartValue['product_id']] = $cartValue['product_count'],
                Categories::TYPE_ACCESSOR => $sessionAccessorId[$cartValue['product_id']] = $cartValue['product_count'],
            };
        }

        if ($cart && is_array($cart) && count($sessionBookId) > 0 || count($sessionAccessorId) > 0) {
            if (count($sessionAccessorId)) {
                Accessor::changeInStockAfterOrder($sessionAccessorId);
            }
            if (count($sessionBookId)) {
                Books::changeInStockAfterOrder($sessionBookId);
            }
        }

        session()->forget('cart');
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Builder
     */
    public static function getOrderWithProducts(): Model|\Illuminate\Database\Eloquent\Builder
    {
        return Order::with(['country',
            'books' => function ($query) {
                $query->where('product_type', 'book');
            },
            'accessors' => function ($query) {
                $query->where('product_type', 'accessor');
            }])
            ->orderBy('id', 'DESC')->firstOrFail();
    }

    /**
     * @param $order_payment_id
     * @return mixed
     */
    public static function getOrderWithProductsByPaymentId($order_payment_id)
    {
        return Order::where('order_payment_id', $order_payment_id)
            ->with(['country',
                'books' => function ($query) {
                    $query->where('product_type', 'book');
                },
                'accessors' => function ($query) {
                    $query->where('product_type', 'accessor');
                }])
            ->orderBy('id', 'DESC')->firstOrFail();
    }


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
        return $this->belongsToMany(Books::class, 'order_product_pivote', 'order_id', 'product_id')
            ->withPivot('id', 'quantity', 'price', 'status', 'product_type')
            ->withTimestamps();
    }

    public function accessors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Accessor::class, 'order_product_pivote', 'order_id', 'product_id')
            ->withPivot('id', 'quantity', 'price', 'status', 'product_type')
            ->withTimestamps();
    }
}
