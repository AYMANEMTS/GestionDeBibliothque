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
        Schema::disableForeignKeyConstraints();
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateure_id');
            $table->unsignedBigInteger('livre_id');
            $table->foreign('utilisateure_id')->references('id')->on('utilisateures')->onDelete('cascade');
            $table->foreign('livre_id')->references('id')->on('livre')->onDelete('cascade');
            $table->dateTime('date_emp');
            $table->dateTime('date_fin');
            $table->enum('status',['refuse','attend','accepter']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
