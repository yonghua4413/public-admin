<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class AdminRepository
{
    public function getAdminInfo($where, $field = "*")
    {
        return DB::table("admin")->where($where)->first($field);
    }
}
