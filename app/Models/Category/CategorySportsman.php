<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static exists()
 * @method static find($id)
 * @method static limit(int $random_int)
 * @method static inRandomOrder()
 * @method static leftJoin(string $string, string $string1, string $string2)
 * @method static where()
 * @method static whereIn()
 * @method static select(string $string)
 * @method static get()
 */
class CategorySportsman extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo'];

}
