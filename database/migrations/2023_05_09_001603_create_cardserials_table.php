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
        Schema::create('cardserials', function (Blueprint $table) {
            $table->id();
            $table->text('serial');
            $table->boolean("used")->default(0);
            $table->bigInteger('invoicecard_id')->nullable()->index();
            $table->foreignId('cardvariant_id')->nullable()->constrained()->cascadeOnDelete();           
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
        Schema::dropIfExists('cardserials');
    }
};
