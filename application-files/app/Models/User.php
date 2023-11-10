<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
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
        'password' => 'hashed',
    ];

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     /* HANDLE EVENT ON CREATE  */
    //     static::creating(function ($user) {
    //         $detail = $user->detail;
    //         Log::info('Creating event dispatched.', ['user_id' => $user->id, 'detail' => $detail]);
    //         event(new UserSaved($user, $detail));
    //     });

    //     /* HANDLE  EVENT ON UPDATE*/
    //     static::updating(function ($user) {
    //         $detail = $user->detail;
    //         Log::info('Updating event dispatched.', ['user_id' => $user->id, 'detail' => $detail]);
    //         event(new UserSaved($user, $detail));
    //     });
    // }
}
