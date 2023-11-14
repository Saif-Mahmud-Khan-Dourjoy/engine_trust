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
    public function deleted_query(){
        return $this->hasMany(DeletedQuery::class);
    }
}
