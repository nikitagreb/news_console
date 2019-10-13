<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParseNewsTable extends Migration
{
    /** @var string */
    private const TABLE_NAME = 'parse_news';

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
            $table->unsignedInteger('source_id')->comment('Источник');
            $table->string('title_selector', 1000)->comment('Селектор для заголовка');
            $table->string('description_selector', 1000)->comment('Селектор для описания');
            $table->string('image_selector', 1000)->comment('Селектор для изображения');
            $table->string('content_selector', 1000)->comment('Селектор для контента новости');
            $table->string('content_filter_selector', 1000)->comment('Селектор для фильтрации контента новости');
            $table->timestamps();

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
