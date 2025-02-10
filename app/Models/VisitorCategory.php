<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCategory extends Model
{
    use HasFactory;

    protected $table='visitorcategory';
    protected $fillable=['Category'];
}
