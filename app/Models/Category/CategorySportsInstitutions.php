<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static exists()
 * @method static find($id)
 * @method static pluck(string $string, string $string1)
 * @method static where(string $string, string $string1, $id)
 * @method static whereIn(string $string, $pluck)
 */
class CategorySportsInstitutions extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
    ];
}
