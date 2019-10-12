<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('parse_link_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id')->comment('Категория');
            $table->unsignedInteger('source_id')->comment('Источник');
            $table->text('title')->comment('Заголовок');
            $table->string('link', 700)->unique()->comment('Ссылка');
            $table->enum('status', ['new', 'loaded'])->default('new')->comment('Статус');
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
