<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $column, int $value)
 * @property $id
 * @property $id_user
 * @property $item_id
 * @property $id_category
 * @property $counter
 * @property $name_item
 * @property $quantity
 * @property $description
 * @property $created_at
 * @property $updated_at
 */
class Items extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $guarded = [
        'id'
    ];

//    Table Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }
}
