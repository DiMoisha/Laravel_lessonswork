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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderid');
            $table->string('sourceemail', 255)->nullable()->comment('E-mail источника');
            $table->string('customername', 255)->comment('Имя заказчика');
            $table->string('customertel', 255)->comment('Телефоны заказчика');
            $table->string('customeremail', 255)->comment('Е-mail заказчика');
            $table->text('description', 255)->comment('Описание что нужно');
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
        Schema::dropIfExists('orders');
    }
};
