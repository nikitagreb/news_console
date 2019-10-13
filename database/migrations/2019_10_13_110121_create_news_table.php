<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /** @var string */
    private const TABLE_NAME = 'news';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->unsignedInteger('category_id')->comment('Категория');
            $table->unsignedInteger('source_id')->comment('Источник');

            $table->string('link', 1000)->comment('Ссылка на новость');
            $table->string('title', 1000)->comment('Заголовок');
            $table->string('description', 1000)->comment('Описание');
            $table->string('image', 1000)->comment('Изображение');
            $table->text('text')->comment('Текст новости');
            $table->enum('status', ['published', 'unpublished'])->default('published')->comment('Статус');
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
        Schema::dropIfExists(static::TABLE_NAME);
    }
}
