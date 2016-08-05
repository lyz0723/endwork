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


    public function lianjie(){
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
            $this -> getSignPackage();
        }
    }



    //获取Access_token
    public function getWxAccessToken(){
        $appid="wx9036c924e93284c6";
        $appsecret = "b6ace35d7f3820f253b6c770d6a028e4";
        //$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=". $appid ."&secret=". $appsecret;
        $res = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret");
        $res = json_decode($res, true);
        $access_token = $res['access_token'];
        return $access_token;
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
    /*
     * 微信JS-SDK
     * */
    //获取jsapi_ticket
    public function ticket(){
        $access_token=$this->getWxAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi";
        $file=file_get_contents($url);
        $arr=json_decode($file,true);
        $jsapi_ticket=$arr['ticket'];
        return $jsapi_ticket;
    }
    //获取签名字段随机字符串
    public function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //获取
    public function getSignPackage(){
        //获取jsapi_ticket
        $jsapiTicket = $this->ticket();
        //随机字符串
        $nonceStr=$this->createNonceStr();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
            "appId"     => "wx9036c924e93284c6",
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        $news = array("Title" =>"微信公众平台开发实践",
            "Description"=>"本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。",
            "PicUrl" =>'http://images.cnitblog.com/i/340216/201404/301756448922305.jpg',
            "Url" =>'http://www.cnblogs.com/txw1958/p/weixin-development-best-practice.html');
        //print_r($signPackage) ;
        return view('login/weixin',['signPackage'=>$signPackage,'news'=>$news]);
    }
    //微信登录
    public function Login_code(){
        //公众号appid
        $appId="wx9036c924e93284c6";
        //根据appid获取code
        $url="http://www.zhangqiuxiang.top/endwork/hospital/public/get_code";
        $url=urlencode($url);
        $path="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$url&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        header( 'location:'. $path);
    }
    //获取微信公众号的code
    public function get_code(){
        $appId="wx9036c924e93284c6";
        $appSecret="b6ace35d7f3820f253b6c770d6a028e4";
        $code=Request::input('code');
        echo $code;
        //通过code获取openid
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code";
        $arr=file_get_contents($url);
        $data=json_decode($arr,true);
        print_r($data);
    }
}
?>