<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllLoginTimeline extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $table='all_login_timelines';
}
