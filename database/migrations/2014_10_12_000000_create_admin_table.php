<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pid')->default(0);
            $table->string('name')->default("");
            $table->char('mobile', 11)->default("");
            $table->string('email')->default("");
            $table->string('password');
            $table->text('purview_ids')->comment("权限ids ‘,’ 隔开");
            $table->integer('create_id')->default(0)->comment("创建人");
            $table->tinyInteger('is_limit')->default(0)->comment("是否限制登陆");
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
        Schema::dropIfExists('admin');
    }
}
