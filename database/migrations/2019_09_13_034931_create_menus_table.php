<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->default("")->comment("名称");
            $table->integer('pid')->default(0);
            $table->string('class', 32)->default("fa fa-th-large")->comment('图标');
            $table->tinyInteger('is_show')->default(0);
            $table->tinyInteger('is_del')->default(0);
            $table->tinyInteger('sort')->default(0);
            $table->integer('create_id')->default(0);
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
        Schema::dropIfExists('menus');
    }
}
