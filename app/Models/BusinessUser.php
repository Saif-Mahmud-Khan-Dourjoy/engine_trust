<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class BusinessUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
   
    protected $guard='businessUser';
     
    protected $table = 'business_users';

    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
}
