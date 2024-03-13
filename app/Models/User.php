<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
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
 * @property Group[]|Collection $groups
 * @property Activity[]|Collection $activities
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Filterable;

    const ROLE_CURATOR = 'curator';
    const ROLE_ADMIN = 'admin';

    const ROLE_NAMES = [
        self::ROLE_CURATOR => 'Куратор',
        self::ROLE_ADMIN => 'Администратор',
    ];

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
     * Группы пользователя
     *
     * @return HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    /**
     * Мероприятия пользователя
     *
     * @return HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

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

    /**
     * Получение названия роли
     *
     * @return string
     */
    public function getRoleNameAttribute(): ?string
    {
        $roleName = $this->roles()->first()->name;

        return self::ROLE_NAMES[$roleName] ?? null;
    }

    /**
     * Получение только кураторов.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeCurators(Builder $query): Builder
    {
        return $query->role([self::ROLE_CURATOR]);
    }
}
