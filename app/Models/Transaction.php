<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $column, $value)
 * @property $id
 * @property $id_user
 * @property $transaction_code
 * @property $transaction_id
 * @property $counter
 * @property $transaction_date
 * @property $description
 * @property $created_at
 * @property $updated_at
 */
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $guarded = [
        'id'
    ];

    public function transaction_type(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'transaction_code', 'transaction_code');
    }
}
