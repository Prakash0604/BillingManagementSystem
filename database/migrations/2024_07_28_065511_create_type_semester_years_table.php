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
        Schema::create('type_semester_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_id');
            $table->foreign('data_id')->references('id')->on('semesters')->onUpdate('cascade');
            $table->string('name')->unique();
            $table->boolean('running')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_semester_years');
    }
};
