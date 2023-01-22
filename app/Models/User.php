<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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

    public function gangas() {
        return $this->hasMany('App\Models\Ganga');
    }

    public function likes() {
        return $this->belongsToMany('App\Models\Ganga', 'likes', 'user_id', 'ganga_id')->withPivot('liked', 'unliked')->where('user_id', '=' , Auth::id());    }

    public function rols() {
        return $this->belongsToMany('App\Models\Rol');
    }

    public function hasRol($rol)
    {
        return User::where('rol', $rol)->get();
    }
}
