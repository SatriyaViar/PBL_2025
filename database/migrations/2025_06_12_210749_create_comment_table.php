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
        Schema::create('t_comment', function (Blueprint $table) {
            $table->id('comment_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('status', ['pending', 'revision', 'verified'])->default('pending');
            $table->text('comment')->nullable();
            $table->timestamps();

	        $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('t_comment');
    }
};
