<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    use HasFactory;
    protected $table = 'enquiries'; // Define the table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'country',
        'state',
        'is_nri',
        'program',
        'course',
    ]; // Mass assignable fields

    protected $casts = [
        'is_nri' => 'boolean', // Cast is_nri to boolean
    ];
}
