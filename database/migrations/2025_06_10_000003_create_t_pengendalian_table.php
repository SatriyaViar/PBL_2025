<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_pengendalian', function (Blueprint $table) {
            $table->id('pengendalian_id');
            $table->unsignedBigInteger('kriteria_id')->index();
            $table->longText('description')->nullable();
            $table->string('link')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();

            $table->foreign('kriteria_id')->references('kriteria_id')->on('m_kriteria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_pengendalian');
    }
};
