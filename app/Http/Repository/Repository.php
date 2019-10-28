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

    public function getList($table, $where = [], $field = ['*'], $orderBy = [], $limit = 0, $group = [])
    {
        return DB::table($table)
            ->where($where)
            ->when(count($orderBy), function ($query) use ($orderBy) {
                foreach ($orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->when(count($group), function ($query) use ($group) {
                $query->groupBy($group);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->get($field)
            ->toArray();
    }

    public function getListByPage($table, $where = [], $field = ['*'], $orderBy = [], $offset = 10, $page = 1, $group = [])
    {

    }
}
