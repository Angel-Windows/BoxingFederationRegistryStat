<?php

namespace App\Models\Linking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static insert(array[] $array)
 * @method static where(string $string, $id)
 * @method static leftJoin(string $string, string $string1, string $string2)
 * @method static get()
 * @method static whereNotNull(string $string)
 * @method static whereNull(string $string)
 * @method static whereIn(string $string)
 */
class LinkingMembers extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_end_at'
    ];

}
