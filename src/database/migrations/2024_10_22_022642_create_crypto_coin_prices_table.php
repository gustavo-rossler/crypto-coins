<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptoCoinPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_coin_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crypto_coin_api_id', 30);
            $table->integer('timestamp')->unique();
            $table->dateTime('datetime');
            $table->decimal('price', 10, 5);

            $table->foreign('crypto_coin_api_id')->references('api_id')->on('crypto_coins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_coin_prices');
    }
}
