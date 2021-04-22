<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('from_currency_id')->nullable();
            $table->bigInteger('to_currency_id')->nullable();
            $table->float('rate');

            //$table->foreign('from_currency_id')->references('id')->on('countries');
            //$table->foreign('to_currency_id')->references('id')->on('countries');

            $table->index(['from_currency_id','to_currency_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
