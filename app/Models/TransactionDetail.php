<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $column, mixed $value)
 * @property $transaction_id
 * @property $item_id
 * @property $id_user
 * @property $quantity
 * @property $description
 * @property $created_at
 * @property $updated_at
 */
class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class, 'item_id', 'id');
    }
}
