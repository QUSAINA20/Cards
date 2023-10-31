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
        Schema::create('card_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->integer('daily_price')->nullable();
            $table->string('placeholder')->nullable();
            $table->enum('status', ['Active', 'Deactivated'])->default('Deactivated');
            $table->bigInteger('card_type_id')->unsigned();
            $table->foreign('card_type_id')->references('id')->on('card_types')->onDelete('cascade');
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
        Schema::dropIfExists('card_values');
    }
};
