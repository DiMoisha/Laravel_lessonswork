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
        Schema::table('news',  function (Blueprint $table) {
            $table->foreignId('categoryid')
                ->comment('ID категории')
                ->after('newsid')
                ->constrained('categories','categoryid')
                ->onDelete('cascade');
            $table->foreignId('feedsourceid')
                ->nullable()
                ->comment('ID источника новости')
                ->after('categoryid')
                ->constrained('feedsources','feedsourceid')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropConstrainedForeignId('categoryid');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->dropConstrainedForeignId('feedsourceid');
        });
    }
};
