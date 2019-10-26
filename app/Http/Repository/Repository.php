<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class Repository
{
    public function getOne($table, $where = [], $field = ['*'])
    {
        return DB::table($table)->where($where)->first($field);
    }

    public function checkExists($table, $where = [])
    {
        return DB::table($table)->where($where)->exists();
    }

    public function count($table, $where = [], $field = ['*'])
    {
        return DB::table($table)->where($where)->count($field);
    }

    public function update($table, $where = [], $data)
    {
        return DB::table($table)->where($where)->update($data);
    }

    public function insert($table, $data)
    {
        return DB::table($table)->insertGetId($data);
    }
}
