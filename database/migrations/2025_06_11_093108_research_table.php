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
        Schema::create('m_research', function (Blueprint $table) {
            $table->id('research_id');
            $table->string('letter_no')->nullable();
            $table->string('reserach_title');
            $table->string('internal_funding')->nullable();
            $table->string('external_funding')->nullable();
            $table->string('research_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_research');
    }
};
