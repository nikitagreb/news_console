<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableParseCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parse_category', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->unsignedInteger('category_id')->comment('Категория');
            $table->unsignedInteger('source_id')->comment('Источник');
            $table->string('link', 250)->comment('Ссылка на страницу категории');
            $table->string('linkSelector', 250)->comment('Css селектор для ссылки');
            $table->enum('status', ['new', 'loaded'])->default('new')->comment('Статус');
            $table->timestamps();

            $table->primary(['category_id', 'source_id']);

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
        Schema::dropIfExists('parse_category');
    }
}
