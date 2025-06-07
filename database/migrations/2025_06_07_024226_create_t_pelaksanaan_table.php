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
        Schema::create('t_pelaksanaan', function (Blueprint $table) {
            $table->id('pelaksanaan_id');
            $table->unsignedBigInteger('criteria_id')->index();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();

            $table->foreign('criteria_id')->references('criteria_id')->on('t_criteria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pelaksanaan');
    }
};
