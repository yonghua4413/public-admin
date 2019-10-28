<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_class', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_name', 30)->default("")->comment("分类名称");
            $table->integer('pid')->default(0)->comment("父级id");
            $table->integer('sort')->default(0)->comment("排序");
            $table->tinyInteger('is_show')->default(0)->comment("是否显示");
            $table->tinyInteger('is_del')->default(0)->comment("是否删除");
            $table->integer("create_id")->default(0)->comment("创建人");
            $table->integer("update_id")->default(0)->comment("最后更新人");
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
        Schema::dropIfExists('goods_class');
    }
}
