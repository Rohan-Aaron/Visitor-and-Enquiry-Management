<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
   use HasFactory;
   protected $table='visits';

   protected $fillable = [
        'visitor_id', 'category', 'other_category', 'description', 'arrived_at', 'exited_at', 'visit_date'
    ];
    
   public function visitor(){
    return $this->belongsTo(Visitors::class);
   }
}
