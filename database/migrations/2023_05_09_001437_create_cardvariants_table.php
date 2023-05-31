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
        Schema::create('cardvariants', function (Blueprint $table) {
            $table->id();
            $table->text('image_ar')->nullable();
            $table->text('image_en')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->double('price',15,2);
            $table->double('price2',15,2);
            $table->double('price3',15,2);
            $table->foreignId('card_id')->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('cardvariants');
    }
};
