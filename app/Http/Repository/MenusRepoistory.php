<?php
/**
 * Created by PhpStorm.
 * User: yonghua
 * Date: 2019/5/26
 * Time: 21:28
 */

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class MenusRepoistory
{
    public function getMenus($where, $field = ['*'], $order_by = [])
    {
        return DB::table('menus')
            ->where($where)
            ->when(count($order_by), function ($query) use ($order_by) {
                foreach ($order_by as $item => $value) {
                    $query->orderBy($item, $value);
                }
            })
            ->get($field);
    }
}