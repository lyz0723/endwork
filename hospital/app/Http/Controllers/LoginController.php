<?php
namespace App\Http\Controllers;
use Gregwar\Captcha\CaptchaBuilder;
use Request;
use Input , Response;
use Session;
use DB;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('login/login');
    }
    public function login(){
        return view('login/lists');
    }
    //判断用户登录
    public function login_do()
    {
        $username = Request::input('username');

        $password = md5(trim(Request::input('password')));
        $row=DB::table('user')->where('username',$username)->first();
       // print_r($row);die;
        if ($row && !empty($row)) {
            if ($row->username == $username && $row->password == $password) {
                if ($row->password == $password) {
                    $string1 = json_encode(array("code"=>0, "des"=>"success"));
                    echo($string1);
//                    $res = urlencode("登录成功");
//                    exit(json_encode($res));
                } else {
                    $string1 = json_encode(array("code"=>1, "des"=>"wrong password"));
                    echo($string1);
//                    $res = urlencode("密码错误");
//                    exit(json_encode($res));
                }
            } else {
                $string1 = json_encode(array("code"=>2, "des"=>"error"));
                echo($string1);
//                $res = urlencode("用户名密码错误");
//                exit(json_encode($res));
            }
        } else {
            $string1 = json_encode(array("code"=>2, "des"=>"usernull"));
            echo($string1);
//            $res = urlencode("用户名不存在");
//            exit(json_encode($res));
        }
        /*
         * 0：表示登录成功，1：表示密码错误，2：用户名密码错误，3：用户名不存在
         */
    }
    //微信扫码登录
    public function weixin(){
        //测试号
        $appId="wx9036c924e93284c6";
        //$appSecret="b6ace35d7f3820f253b6c770d6a028e4";
        $url="http://www.zhangqiuxiang.top";
        $url=urlencode($url);
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$url&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        echo $url;
    }
    //获取code
    public function code(){
        $code=Request::input('code');
    }
}
?>