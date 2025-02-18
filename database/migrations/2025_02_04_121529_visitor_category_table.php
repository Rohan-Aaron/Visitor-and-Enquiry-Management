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
        Schema::create('Enquirycategory',function(Blueprint $table){
            $table->id();
            $table->string('Course',50);
            $table->string('Combination',50);
        });
        Schema::create('Visitorcategory',function(Blueprint $table){
            $table->id();
            $table->string('Category',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Visitorcategory');
        Schema::dropIfExists('Enquirycategory');
    }
};
