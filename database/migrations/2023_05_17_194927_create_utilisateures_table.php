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
        Schema::create('utilisateures', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('adress');
            $table->string('CIN');
            $table->enum('role',['etudiant','admin','superadmin']);
            $table->enum('gender',['male','female']);
            $table->string('password');
            $table->string('profile_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateures');
    }
};
