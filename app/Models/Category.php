<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $column, int $value)
 * @method static find(int $id)
 * @property $id
 * @property $id_user
 * @property $category_id
 * @property $name_category
 * @property $description
 * @property $created_at
 * @property $updated_at
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = [
        'id'
    ];

//    Table Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Items::class, 'id_category', 'id');
    }
}
