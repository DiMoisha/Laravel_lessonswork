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
        Schema::create('feedsources', function (Blueprint $table) {
            $table->id('feedsourceid');
            $table->string('sourcename', 255)->comment('Наименование источника');
            $table->text('sourceurl')->nullable()->comment('URL источника');
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
        Schema::dropIfExists('feedsources');
    }
};
