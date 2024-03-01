<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static truncate()
 * @method static exists()
 * @method static where(string $string)
 */
class EmployeesSportsInstitutions extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
    ];
}
