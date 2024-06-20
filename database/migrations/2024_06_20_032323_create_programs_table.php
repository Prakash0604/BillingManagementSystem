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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_name');
            $table->enum('faculty',['Humanity','Management','Science','Health & Science','Science & Technology','Law'])->nullable();
            $table->enum('univeristy',['CTEVT','Gandaki univeristy','Kathmandu Univeristy','Tribhuvan Univeristy','Pokhara Univeristy','Purbanchal Univeristy','Neb','Others'])->nullable();
            // $table->enum('type',['Semester','Year','N\A'])->nullable();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->onUpdate('cascade')->on('types');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
