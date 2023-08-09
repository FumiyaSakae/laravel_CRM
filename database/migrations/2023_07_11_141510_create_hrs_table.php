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
        Schema::create('hrs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_kana');
            $table->string('area');
            $table->string('current_process')->nullable();
            $table->string('memo')->nullable();
            $table->integer('min_price');
            $table->integer('current_price')->nullable();
            $table->tinyInteger('is_selling')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrs');
    }
};
