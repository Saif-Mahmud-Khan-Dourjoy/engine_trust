<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $table='enquiries';
    protected $guarded=[];

    public function quotes(){
        return $this->hasMany(Quote::class);
    }
}
