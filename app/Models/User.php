<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static find(int $id)
 * @method static where(string $column, string $value)
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property $created_at
 * @property $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    Table Relation
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'id_user', 'id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'id_user', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Items::class, 'id_user', 'id');
    }
}
