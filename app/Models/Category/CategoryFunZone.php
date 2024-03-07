<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static exists()
 * @method static find(mixed $id)
 * @method whereJsonContains(string $string, int[] $array)
 * @method get()
 */
class CategoryFunZone extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
    ];
}
