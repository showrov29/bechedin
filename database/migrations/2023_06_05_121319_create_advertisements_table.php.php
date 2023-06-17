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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('productName');
            $table->integer('price');
            $table->string('description');
            $table->string('profileImage');
            $table->string('desImage1')->nullable();
            $table->string('desImage2')->nullable();
            $table->string('desImage3')->nullable();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('mainCategoryId');
            $table->unsignedBigInteger('mainBrandId');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
