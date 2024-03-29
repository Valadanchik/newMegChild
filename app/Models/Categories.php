<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    const TYPE_BOOK = 'book';
    const TYPE_ACCESSOR = 'accessor';
    const PRODUCTS_TYPE = [
        self::TYPE_BOOK,
        self::TYPE_ACCESSOR,
    ];

    const AYB = 1;
    const BEN = 2;
    const GIM = 3;
    const DA = 4;
    const PARENT = 5;

    const AYB_AGE = '0-6';
    const BEN_AGE = '6-9';
    const GIM_AGE = '9-12';
    const DA_AGE = '12+';
    const PARENT_AGE = 'ծնող';

    const AGES = [
        self::AYB_AGE,
        self::BEN_AGE,
        self::GIM_AGE,
        self::DA_AGE,
        self::PARENT_AGE,
    ];
    const NAMES = [
        ['hy' => 'այբ', 'en' => 'ayb'],
        ['hy' => 'բեն', 'en' => 'ben'],
        ['hy' => 'գիմ', 'en' => 'gim'],
        ['hy' => 'դա', 'en' => 'da'],
        ['hy' => 'ծնող', 'en' => 'parent'],
    ];

    protected $fillable = [
        'id',
        'type',
        'name_hy',
        'name_en',
        'age',
    ];

    /**
     * @param $slug
     * @return int
     */
    public static function bookCategorySlug($slug): int
    {
        return Categories::where('name_en', $slug)->firstOrFail()->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Books::class);
    }
}
