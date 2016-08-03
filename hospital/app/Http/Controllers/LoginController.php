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
        $url="http://www.zhangqiuxiang.top/endwork/hospital/public/code";
        $url=urlencode($url);
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$url&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        echo $url;
    }
    //获取code
    public function code(){
        $appId="wx9036c924e93284c6";
        $appSecret="b6ace35d7f3820f253b6c770d6a028e4";
        $code=$_GET['code'];
        //通过获取的code去获取
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code ";
        $file=file_get_contents($url);
        $arr=json_decode($file,true);
        $access_token=$arr['access_token'];
        //echo $access_token;
        //通过$access_token拉去用户信息
        $url1="https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$appId&lang=zh_CN ";
        $news=file_get_contents($url1);
        $news=json_decode($news,true);
        //openid
        $openid=$news['openid'];
        echo $openid."<br/>";
        //昵称
        $name=$news['nickname'];
        echo $name."<br/>";
        //性别
        $sex=$news['sex'];
        echo $sex."<br/>";
        //用户个人资料填写的省份
        $province=$news['province'];
        echo $province."<br/>";
        //城市
        $city=$news['city'];
        echo $city."<br/>";
        //国家
        $country=$news['country'];
        echo $country."<br/>";
        //头像
        $headimgurl=$news['headimgurl'];
        echo $headimgurl."<br/>";
    }
    //微信基本的功能
    public function weixins(){
        // 1.将timestamp， nonce，token 按字典排序
        $timestamp =$_GET['timestamp'];
        $nonce     = $_GET['nonce'];
        $token     = 'weixin';
        $signature = $_GET['signature'];
        $array     = array( $timestamp, $nonce, $token );
        sort( $array );
        // 2.将排序后的三个参数拼接之后用sha1加密
        $tmpstr    = implode('', $array);
        $tmpstr    = sha1( $tmpstr );
        // 3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
        $echoster=$_GET['echostr'];
        if ( $tmpstr == $signature && $echoster) {
            echo $_GET['echostr'];
            exit;
        }else {
            $this -> responseMsg();
        }
    }
    public function  responseMsg(){
        
    }
}
?>