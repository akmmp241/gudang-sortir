<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $column, mixed $value)
 * @property $transaction_code
 * @property $transaction_name
 * @property $description
 */
class TransactionType extends Model
{
    use HasFactory;

    protected $table = 'transaction_type';
}
