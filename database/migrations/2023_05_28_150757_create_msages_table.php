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
        Schema::create('msages', function (Blueprint $table) {
            $table->id();
            $table->text('msage');
            $table->enum('status',['accepter','refuse','rendu']);
            $table->unsignedBigInteger('emprunt_id');
            $table->foreign('emprunt_id')->references('id')->on('emprunts')->cascadeOnDelete();
            $table->unsignedBigInteger('utilisateure_id');
            $table->foreign('utilisateure_id')->references('id')->on('utilisateures')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msages');
    }
};
