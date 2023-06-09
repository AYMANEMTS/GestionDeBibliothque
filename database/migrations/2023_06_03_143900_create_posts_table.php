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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateure_id');
            $table->foreign('utilisateure_id')->references('id')->on('utilisateures')->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('body');
            $table->enum('status',['accepter','attend','refuse']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
