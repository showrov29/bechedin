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
        Schema::table('advertisements', function (Blueprint $table) {
           $table->boolean('status')->default(false);
           $table->unsignedBigInteger('subBrandId');
           $table->unsignedBigInteger('subCategoryId');
           $table->foreign('subCategoryId')->references('id')->on('subCategories');
           $table->foreign('subBrandId')->references('id')->on('subBrands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            //
        });
    }
};
