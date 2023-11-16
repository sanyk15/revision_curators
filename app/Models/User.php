<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $surname
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ROLE_USER = 'user';
    const ROLE_CURATOR = 'curator';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
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

    /**
     * Получение сокращенного имени (Иванов И. И.)
     *
     * @return string
     */
    public function getShortNameAttribute(): string
    {
        $string = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '.';
        $string .= $this->surname ? ' ' . mb_substr($this->surname, 0, 1) . '.' : '';

        return $string;
    }

    /**
     * Получение полного ФИО
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $string = $this->last_name . ' ' . $this->first_name;
        $string .= $this->surname ? ' ' . $this->surname : '';

        return $string;
    }
}
