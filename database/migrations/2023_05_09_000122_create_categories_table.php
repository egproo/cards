<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name_en');
            $table->text('fulldesc_en');
            $table->string('desc_en')->nullable();
            $table->string('slug_en')->unique();
            $table->text('image_en')->nullable();
            $table->string('name_ar');
            $table->text('fulldesc_ar');
            $table->string('desc_ar')->nullable();
            $table->string('slug_ar')->unique();
            $table->text('image_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
