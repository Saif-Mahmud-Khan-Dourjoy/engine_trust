<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionNotes extends Model
{
   use HasFactory;
    protected $table="subscription_notes";
    protected $guarded=[];
    public function business_profile(){
        return $this->belongsTo(BusinessProfile::class,'business_profile_id');
    }
}