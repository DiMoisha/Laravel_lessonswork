<?php

use App\Models\News;
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
        Schema::create('news', function (Blueprint $table) {
            $table->id('newsid');
            $table->string('title', 255)->comment('Заголовок');
            $table->text('description')->nullable()->comment('Содержание');
            $table->string('author', 255)->nullable()->comment('Автор');
            $table->string('image', 255)->nullable()->comment('Ссылка на картинку');
            $table->enum('status', [
                        News::DRAFT, News::ACTIVE, News::BLOCKED
                    ])->default(News::DRAFT)->comment('Статус');
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
        Schema::dropIfExists('news');
    }
};
