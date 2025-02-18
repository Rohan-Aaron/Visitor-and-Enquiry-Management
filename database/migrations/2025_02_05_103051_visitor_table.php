<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Visitors table
        Schema::create('visitors',function(Blueprint $table){
            $table->id('visitor_id');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->string('phone',15);
            $table->timestamps();
        });

        //Visits table
        Schema::create('visits',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('visitor_id');
            $table->string('category',40);
            $table->string('other_category',50)->nullable();

            $table->text('description')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('exited_at')->nullable();
            $table->timestamps();

            // Foreign key constraint to visitors table
            $table->foreign('visitor_Id')->references('visitor_Id')->on('visitors')
                  ->onDelete('cascade'); 
        });

        
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
        Schema::dropIfExists('visitors');
    }
};
