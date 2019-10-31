<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class Repository
{
    public $orderBy = [];
    public $limit = 0;
    public $group = [];
    public $offset = 10;
    public $page = 1;

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

    public function getList($table, $where = [], $field = ['*'])
    {
        return DB::table($table)
            ->where($where)
            ->when(count($this->orderBy), function ($query) {
                foreach ($this->orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->when(count($this->group), function ($query) {
                $query->groupBy($this->group);
            })
            ->when($this->limit, function ($query) {
                $query->limit($this->limit);
            })
            ->get($field)
            ->toArray();
    }

    public function getEachPageList($table, $where = [], $field = ['*'])
    {
        return DB::table($table)
            ->select($field)
            ->where($where)
            ->when(count($this->orderBy), function ($query) {
                foreach ($this->orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->when(count($this->group), function ($query) {
                $query->groupBy($this->group);
            })
            ->when($this->limit, function ($query) {
                $query->limit($this->limit);
            })
            ->forPage($this->page)
            ->paginate($this->offset);
    }
}
