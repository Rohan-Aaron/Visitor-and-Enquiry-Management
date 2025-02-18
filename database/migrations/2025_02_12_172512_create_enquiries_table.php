<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // VARCHAR equivalent
            $table->string('email')->unique(); // Unique email field
            $table->string('phone'); // Phone number
            $table->enum('gender', ['Male', 'Female', 'Other']); // Enum for gender
            $table->string('country'); // Country name
            $table->string('state')->nullable(); // State (nullable if not in India)
            $table->boolean('is_nri'); // Boolean (1 = Yes, 0 = No)
            // Define foreign keys
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('course_id');

            // Set foreign key constraints
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->timestamps(); // Created at & Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
