<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //创建概述
        DB::table('menus')->insert(['name' => '概述', 'url' => '/', 'is_show' => 1]);

        //创建内容管理
        $insertId = DB::table('menus')->insertGetId([
            'name' => '内容管理',
            'class' => 'fa fa-desktop',
            'url' => '',
            'is_show' => 1
        ]);
        //创建内容管理子菜单
        DB::table('menus')->insert([
            ['name' => '分类管理', 'pid' => $insertId, 'url' => '/content/classify', 'is_show' => 1],
            ['name' => '文章列表', 'pid' => $insertId, 'url' => '/content/list', 'is_show' => 1]
        ]);

        $insertId = DB::table('menus')->insertGetId([
            'name' => '商品管理',
            'class' => 'fa fa-shopping-cart',
            'url' => '',
            'is_show' => 1
        ]);
        //创建商品管理子菜单
        DB::table('menus')->insert([
            ['name' => '商品分类', 'pid' => $insertId, 'url' => '/goods/classify', 'is_show' => 1],
            ['name' => '商品列表', 'pid' => $insertId, 'url' => '/goods/list', 'is_show' => 1]
        ]);
    }
}
