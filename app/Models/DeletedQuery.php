<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedQuery extends Model
{
    use HasFactory;
    protected $table='deleted_queries';
    protected $guarded=[];

}
