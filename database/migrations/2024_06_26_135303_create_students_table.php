<?php

use App\Models\currentbatch;
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
            $table->string('father_name')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('previous_college')->nullable();
            $table->unsignedBigInteger('batchname_id')->nullable();
            $table->foreign('batchname_id')->references('id')->on('batches');
            $table->unsignedBigInteger('programname_id')->nullable();
            $table->foreign('programname_id')->references('id')->on('programs');
            $table->string('year_semester')->nullable();
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
