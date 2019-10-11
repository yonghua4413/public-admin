<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('push_name', 30)->default("")->comment("分类名称");
            $table->tinyInteger('is_del')->default(0)->comment("是否删除");
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
        Schema::dropIfExists('push');
    }
}
