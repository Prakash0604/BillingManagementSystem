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
        Schema::create('currentbatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade');
            $table->enum('semester',['1st semester','2nd semester','3rd semester','4th semester','5th semester','6th semester','7th semester','8th semester'])->nullable()->default('1st semester');
            $table->enum('year',['1st year','2nd year','3rd year','4th year'])->default('1st year')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currentbatches');
    }
};
