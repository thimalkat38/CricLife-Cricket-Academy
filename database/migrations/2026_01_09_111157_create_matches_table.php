<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();

            $table->string('team_1')->nullable();
            $table->string('team_2')->nullable();
            $table->date('date')->nullable();
            $table->string('venue')->nullable();
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
