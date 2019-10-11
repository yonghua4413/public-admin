<?php

namespace App\Http\Controllers;

use App\Http\Providers\HelperProviders;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $request;
    public $helper;

    public function __construct(Request $request, HelperProviders $helper)
    {
        $this->request = $request;
        $this->helper = $helper;
    }

    public function __get($name)
    {
        if ($name == env('ADMIN')) {
            $this->admin = app(Request::class)->session()->get(env("ADMIN"));
            return $this->admin;
        }
        return $this->$name;
    }
}
