<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('student_name',50);
            $table->string('email')->unique()->nullable();
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('contact');
            $table->enum('gender',['Male','Female','Others']);
            $table->string('batch_name')->nullable();
            $table->string('program')->nullable();
            $table->string('type')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('previous_college')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
