<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class ContentRepository
{
    /**
     * @param array $where
     * @param array $field
     * @param array $orderBy
     * @param int $limit
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getContentList(array $where, array $field = ['*'], array $orderBy, int $limit = 12, int $page = 1)
    {
        return DB::table('article')
            ->select($field)
            ->leftJoin("article_class", "article_class.id", '=', "article.class_id")
            ->leftJoin("push", "push.id", '=', "article.push_id")
            ->where($where)
            ->when($orderBy, function ($query) use ($orderBy) {
                foreach ($orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->forPage($page)
            ->paginate($limit);
    }

    public function getPushList($where, $field = ["*"])
    {
        return DB::table('push')->where($where)->get($field)->toArray();
    }

    public function getContentClassList($where, $field = ["*"])
    {
        return DB::table('article_class')->where($where)->get($field)->toArray();
    }

    public function insertContent(array $data)
    {
        return DB::table('article')->insertGetId($data);
    }

    public function upDateContent($where, $data)
    {
        return DB::table('article')->where($where)->update($data);
    }

    public function getContent($where, $field = ["*"])
    {
        return DB::table('article')->where($where)->first($field);
    }

    public function checkExists($where)
    {
        return DB::table('article')->where($where)->exists();
    }

    /**
     * @param array $where
     * @param array $field
     * @return \Illuminate\Support\Collection
     */
    public function getContentClassifyList(array $where, array $field = ['*'])
    {
        return DB::table('article_class')
            ->where($where)
            ->orderBy('sort', 'desc')
            ->get($field);
    }
}