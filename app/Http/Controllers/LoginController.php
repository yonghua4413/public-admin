<?php

namespace App\Http\Controllers;

use App\Http\Repository\AdminRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLogin()
    {
        $data = ['login_app_id' => env("LOGIN_APPID")];
        return view('login/index', $data);
    }

    public function doVerify()
    {
        try {
            if ($this->checkISLogin()) {
                return $this->helper->returnJson([1, [], "您已经登陆，无需重复操作！"]);
            }
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $validator = Validator::make($this->request->post(), [
                'username' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->helper->returnJson([1, [], $validator->errors()->first()]);
            }

            $code = $this->request->post('code');
            $token = $this->request->post('token');

            $url = env('URL_007');
            $arr = [
                'aid' => env('LOGIN_APPID'),
                'AppSecretKey' => env('LOGIN_APPSECRET'),
                'Ticket' => $token,
                'Randstr' => $code,
                'UserIP' => $this->request->ip()
            ];
            $url .= '?' . http_build_query($arr);
            $client = new \GuzzleHttp\Client();
            $info = $client->get($url)->getBody()->getContents();
            if ($info) {
                $info = json_decode($info, true);
                if (isset($info['response']) && $info['response'] == 1) {
                    $admin_repo = app(AdminRepository::class);
                    $where = [
                        ['mobile', '=', $username],
                        ['is_limit', '=', 0],
                        ['is_del', '=', 0],
                    ];
                    $admin = $admin_repo->getAdminInfo($where);
                    if (!$admin) {
                        return $this->helper->returnJson([1, [], '用户不存在']);
                    }
                    $admin = get_object_vars($admin);
                    if ($admin['password'] != md5($password)) {
                        return $this->helper->returnJson([1, [], '用户名或密码不正确']);
                    }
                    unset($admin['password']);
                    $this->request->session()->put(env("ADMIN"), $admin);
                    return $this->helper->returnJson([0, [], "登陆成功"]);
                }
            }
            return $this->helper->returnJson([1, [], '请求异常']);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->helper->returnJson([1, [], '接口相应异常']);
        }
    }


    /**
     * 检测是否已经登陆过了
     * @return bool
     */
    private function checkISLogin()
    {
        $hasLogin = $this->request->session()->exists(env("ADMIN"));
        if ($hasLogin) {
            return TRUE;
        }
        return FALSE;
    }

    public function loginOut()
    {
        $this->request->session()->flush();
        return redirect(route("login"));
    }
}
