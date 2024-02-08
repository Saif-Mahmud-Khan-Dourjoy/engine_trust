<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $table='quotes';
    protected $guarded=[];

    public function enquiry(){
        return $this->belongsTo(Enquiry::class,'enquiry_id');
    }
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function quotelabel(){
        return $this->hasMany(QuoteLabel::class);
    }
    public function job_status(){
        return $this->hasMany(JobStatus::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
