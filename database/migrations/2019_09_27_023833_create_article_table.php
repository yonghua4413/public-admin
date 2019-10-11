<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 90)->default("")->comment("标题");
            $table->string('keywords')->default("")->comment("关键字");
            $table->string('intro')->default("")->comment("简介");
            $table->string("cover_img")->default("")->comment("封面图");
            $table->longText("content")->comment("文章内容");
            $table->integer("cate_id")->default(0)->comment("分类id");
            $table->integer("push_id")->default(0)->comment("发布机构id");
            $table->integer("push_time")->default(0)->comment("发布时间");
            $table->tinyInteger('is_show')->default(1)->comment("是否显示");
            $table->tinyInteger('is_del')->default(0)->comment("是否删除");
            $table->tinyInteger('is_recommend')->default(0)->comment("是否推荐");
            $table->integer("read")->default(0)->comment("阅览量");
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
        Schema::dropIfExists('article');
    }
}
