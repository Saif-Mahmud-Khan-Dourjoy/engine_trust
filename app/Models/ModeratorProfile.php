<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeratorProfile extends Model
{
    use HasFactory;

    protected $table="moderator_profiles";
    protected $guarded=[];
    public function moderator(){
        return $this->belongsTo(Moderator::class,'moderator_id');
    }
}
