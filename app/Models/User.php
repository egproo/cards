<?php

namespace App\Models;



use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = ['currency_id', 'region_id', 'uuid', 'name', 'email', 'phone', 'email_verified_at', 'password', 'two_factor_secret', 'two_factor_recovery_codes', 'two_factor_confirmed_at', 'avatar', 'lastlogin', 'ip', 'remember_token', 'created_at', 'updated_at'];
    public function canAccessFilament():bool{
        return true;
    }

}
