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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('current_batch_id');
            $table->foreign('current_batch_id')->references('id')->on("currentbatches")->onUpdate('cascade');
            $table->unsignedBigInteger('particular_id');
            $table->foreign('particular_id')->references('id')->on('feeparticualrs')->onUpdate('cascade');
            $table->string('times');
            $table->string('amounts');
            $table->string('total_amounts');
            $table->string('net_amounts');
            $table->string('gross_amounts');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
