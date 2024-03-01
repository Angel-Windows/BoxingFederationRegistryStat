<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static insert(array[] $array)
 */
class MyConfig extends Model
{
    use HasFactory;

    protected $table = 'configs';
}
