<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('nic')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('num')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable(); // image path
            $table->string('salary')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
