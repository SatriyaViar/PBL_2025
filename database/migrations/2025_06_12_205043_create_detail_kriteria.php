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
         Schema::create('t_detail_criteria', function (Blueprint $table) {
            $table->id('detail_criteria_id');
            $table->unsignedBigInteger('kriteria_id')->index();
            $table->unsignedBigInteger('penetapan_id')->index();
            $table->unsignedBigInteger('pelaksanaan_id')->index();
            $table->unsignedBigInteger('evaluasi_id')->index();
            $table->unsignedBigInteger('pengendalian_id')->index();
            $table->unsignedBigInteger('peningkatan_id')->index();
            $table->unsignedBigInteger('comment_id')->index();
            $table->timestamps();

            $table->foreign('kriteria_id')->references('kriteria_id')->on('m_kriteria');
            $table->foreign('penetapan_id')->references('penetapan_id')->on('t_penetapan');
            $table->foreign('pelaksanaan_id')->references('pelaksanaan_id')->on('t_pelaksanaan');
            $table->foreign('evaluasi_id')->references('evaluasi_id')->on('t_evaluasi');
            $table->foreign('pengendalian_id')->references('pengendalian_id')->on('t_pengendalian');
            $table->foreign('peningkatan_id')->references('peningkatan_id')->on('t_peningkatan');
            $table->foreign('comment_id')->references('comment_id')->on('t_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('t_detail_criteria');
    }
};
