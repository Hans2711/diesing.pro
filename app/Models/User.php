<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "username", "email", "password"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function getPermissions()
    {
        return json_decode($this->permissions, true);
    }

    public function getPermission($key)
    {
        $permissions = $this->getPermissions();
        return $permissions[$key] ?? null;
    }

    public function generatePermissionsToken()
    {
        if (
            !$this->permissions_token ||
            empty($this->permissions_token) ||
            strlen($this->permissions_token) < 10
        ) {
            $this->permissions_token = sha1(rand());
        }
    }

    public function setPermission($key, $value)
    {
        $permissions = $this->getPermissions();
        $permissions[$key] = $value;

        $this->permissions = json_encode($permissions);
    }

    public function isAdmin()
    {
        return env("ADMIN_USER") === $this->username;
    }

    public function testobjects(): HasMany
    {
        return $this->hasMany(Testobject::class, "user", "id");
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, "user", "id");
    }

    public function redirects(): HasMany
    {
        return $this->hasMany(Redirect::class, "user", "id");
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, "user", "id");
    }
}
