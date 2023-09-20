<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdminProfile extends Model
{
    use HasFactory;

    protected $table="super_admin_profiles";
    protected $guarded=[];
    
    public function superAdmin(){
        return $this->belongsTo(SuperAdmin::class,'super_admin_id');
    }

}
