<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static exists()
 * @method static truncate()
 * @method static find($id)
 * @method static where(string $string, string $string1, $id)
 * @method static pluck(string $string, string $string1)
 */
class CategoryInsurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
    ];
}
