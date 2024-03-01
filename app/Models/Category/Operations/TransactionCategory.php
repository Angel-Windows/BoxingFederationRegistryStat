<?php

namespace App\Models\Category\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $key)
 */
class TransactionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'get_transaction_at',
    ];
}
