<?php

namespace App\Http\Middleware;

use App\Http\Providers\HelperProviders;
use App\Http\Repository\MenusRepoistory;
use Illuminate\Http\Request;
use \Closure;
use Illuminate\Support\Facades\View;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists(env("ADMIN"))) {
            return redirect()->route('login');
        }

        View::share('admin', $this->getAdminSession());
        View::share('menus', $this->getMenus());
        View::share('page_path',  str_replace('//', '/', '/' . $request->path()));
        return $next($request);
    }

    public function getMenus()
    {
        $menus_repo = app(MenusRepoistory::class);
        $where = ['is_del' => 0, 'is_show' => 1];
        $orderBy = ['sort' => 'desc'];
        $filed = ['id', 'pid', 'name', 'url', 'class'];
        $menus = $menus_repo->getMenus($where, $filed, $orderBy);
        return app(HelperProviders::class)->disposeMenus($menus);
    }

    private function getAdminSession()
    {
        return app(Request::class)->session()->get(env("ADMIN"));
    }
}