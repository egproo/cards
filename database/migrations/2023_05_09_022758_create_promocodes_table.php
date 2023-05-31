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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('promocode')->nullable()->index();
            $table->string('promotype')->nullable()->index();
            $table->double('promovalue',15,2);
            $table->foreignId('currency_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean("active");
            $table->date("validfrom");
            $table->date("validto");
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
        Schema::dropIfExists('promocodes');
    }
};
