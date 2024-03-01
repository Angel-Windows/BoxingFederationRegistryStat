<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static exists()
 * @method static truncate()
 * @method static where(string $string, $id)
 */
class EmployeesFederation extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
    ];
}
