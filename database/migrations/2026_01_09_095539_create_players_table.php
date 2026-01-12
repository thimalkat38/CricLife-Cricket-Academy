<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();

            $table->string('school')->nullable();
            $table->string('address')->nullable();

            $table->string('p_name')->nullable();
            $table->string('p_num')->nullable();

            $table->string('num')->nullable();
            $table->string('monthly_fee')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
