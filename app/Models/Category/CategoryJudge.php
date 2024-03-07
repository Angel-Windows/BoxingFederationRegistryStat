<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static exists()
 * @method static find($id)
 * @method static pluck(string $string, string $string1)
 * @method where(string $string, mixed $id)
 * @method get()
 * @method select(string $string, \Illuminate\Contracts\Database\Query\Expression|\Illuminate\Database\Query\Expression $raw)
 * @method whereJsonContains(string $string, int[] $array)
 */
class CategoryJudge extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
    ];
}
