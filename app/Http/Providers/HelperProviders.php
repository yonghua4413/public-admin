<?php

namespace App\Http\Providers;

use App\Http\Repository\Repository;
use Illuminate\Support\Arr;
use Qcloud\Sms\SmsSingleSender;

class HelperProviders
{
    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnJson(array $data)
    {
        return response()->json([
            'status' => Arr::get($data, 0, 0),
            'data' => Arr::get($data, 1, []),
            'message' => Arr::get($data, 2, 'request is ok')
        ]);
    }

    /**
     * 判断是否手机号
     * @param string $string
     * @return bool
     */
    public function isMobile(string $string): bool
    {
        if (preg_match("/^1[34578]\d{9}$/", $string)) {
            return TRUE;
        }
        return FALSE;
    }

    public function disposeMenus($data)
    {
        $array = [];
        foreach ($data as $key => $val) {
            if ($val->pid == 0) {
                $tmp = (array)$val;
                $tmp['child'] = [];
                $array[] = $tmp;
                unset($data[$key]);
            }
        }

        foreach ($array as $k => $v) {
            foreach ($data as $key => $val) {
                if ($v['id'] == $val->pid) {
                    $array[$k]['child'][] = (array)$val;
                }
            }
        }
        return $array;
    }

    public function loopChild($data){
        return $this->disposeMenus($data);
    }

    public function get_random()
    {
        return 'HX' . uniqid() . mt_rand(1000, 9999);
    }

    public function getAdminInfo()
    {
        return session(env("ADMIN"));
    }

    public function checkUserAuth($table, $id)
    {
        $admin = $this->getAdminInfo();
        if (!$admin) {
            return false;
        }
        if ($admin['id'] == 1) {
            return true;
        }
        $where = [['id', '=', $id], ['create_id', '=', $admin['id']]];
        $has = app(Repository::class)->checkExists($table, $where);
        if ($has) {
            return true;
        }
        return false;
    }

    public function disposeLoopData($list, $pid = 0, $level = 1)
    {
        $data = [];
        if ($list && in_array($pid, array_column($list, 'pid'))) {
            foreach ($list as $key => $value) {
                if ($value->pid == $pid) {
                    $value->level = $level;
                    array_push($data, $value);
                    unset($list[$key]);
                    $next = $level + 1;
                    $data = array_merge($data, $this->disposeLoopData($list, $value->id, $next));
                }
            }
        }
        return $data;
    }
}
