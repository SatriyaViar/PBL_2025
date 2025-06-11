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
        Schema::create('t_lecturer_research', function (Blueprint $table) {
            $table->id('lecturer_research_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->unsignedBigInteger('id_research')->index();
            $table->foreign('id_research')->references('research_id')->on('m_research');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_lecturer_research');
    }
};
