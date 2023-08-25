<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserDevices;
use App\Models\UserAdditionals;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_surname',
        'email',
        'phone',
        'fin_code',
        'profile_picture',
        'password',
        'status',
        'is_admin',
        'service_prices',
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
        'status' => 'boolean',
        "service_prices" => "json"
    ];
    public function additionalinfo()
    {
        return $this->hasOne(UserAdditionals::class, 'user_id', 'id');
    }
    public function devices()
    {
        return $this->hasMany(UserDevices::class, 'user_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(UserServices::class, 'user_id', 'id');
    }
    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'user_id', 'id')->orderBy("id", "DESC");
    }
    public function servicenotifications()
    {
        return $this->hasMany(ServiceNotifications::class, 'user_id', 'id');
    }
    public function payments()
    {
        return $this->hasMany(Payments::class, 'user_id', 'id');
    }
}
