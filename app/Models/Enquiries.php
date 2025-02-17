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
        'program_id',
        'course_id',
    ]; // Mass assignable fields

    protected $casts = [
        'is_nri' => 'boolean', // Cast is_nri to boolean
    ];
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    /**
     * Get the course associated with the enquiry.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
