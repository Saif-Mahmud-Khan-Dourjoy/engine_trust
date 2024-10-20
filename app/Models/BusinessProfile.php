<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $table = 'business_profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function subscription_notes(){
        return $this->hasMany(SubscriptionNotes::class);
    }
}