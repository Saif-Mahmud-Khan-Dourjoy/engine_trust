<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteLabel extends Model
{
    use HasFactory;
    protected $table='quote_labels';
    protected $guarded=[];

    public function quote(){
        return $this->belongsTo(Quote::class,'quote_id');
    }
}
