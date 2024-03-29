<?php

use Illuminate\Database\{Migrations\Migration, Schema\Blueprint};
use Illuminate\Support\Facades\Schema;

class CreateTableParseLinkNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(255);
        Schema::create('parse_link_news', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id')->comment('Категория');
            $table->unsignedInteger('source_id')->comment('Источник');
            $table->text('title')->comment('Заголовок');
            $table->string('link', 255)->unique()->comment('Ссылка');
            $table->text('error')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->default(null)->comment('Ошибка парсинга');
            $table->enum('status', ['new', 'loaded', 'error'])->default('new')->comment('Статус');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('category')
                ->onDelete('cascade');
            $table->foreign('source_id')
                ->references('id')->on('parse_source')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parse_link_news');
    }
}
