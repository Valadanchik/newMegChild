<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    const AYB = 1;
    const BEN = 2;
    const GIM = 3;
    const DA = 4;
    const PARENT = 5;

    const AYB_AGE = '0-6';
    const BEN_AGE = '6-9';
    const GIM_AGE = '9-12';
    const DA_AGE = '12+';
    const PARENT_AGE = '18+';

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
        'name_hy',
        'name_en',
        'age',
    ];

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Books::class);
    }
}
