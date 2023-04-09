<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @property $id
 * @property $token
 * @property $id_user
 * @property $created_at
 * @property $updated_at
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
}
