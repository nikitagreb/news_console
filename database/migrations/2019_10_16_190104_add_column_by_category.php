<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnByCategory extends Migration
{
    /** @var string */
    private const TABLE = 'category';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(static::TABLE, function (Blueprint $table) {
            $table->string('title', 100)->comment('Заголовок страницы');
            $table->string('description', 250)->comment('Описание страницы');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(static::CONNECTION)->table(static::TABLE, function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
}
