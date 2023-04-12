<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $column, string $value)
 * @property $id
 * @property $token
 * @property $id_user
 * @property $created_at
 * @property $updated_at
 * @property $user
 */
class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'token',
        'id_user'
    ];

//    Table Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
