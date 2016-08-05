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
            $this -> reponseMeg();
        }
    }


    public function reponseMeg() {

        // 获取微信推送过来post数据（xml格式）
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        // 处理消息类型，并设置回复类型
        $postObj = simplexml_load_string( $postArr );
        // 判断改数据包是否是订阅的事件推送
        if (strtolower( $postObj -> MsgType ) == 'event') {

            // 如果是关注事件subscribe
            if (strtolower( $postObj -> Event == 'subscribe')) {
                // 回复消息
                $toUser   = $postObj -> FromUserName;
                $fromUser = $postObj -> toUserName;
                $time     = time();
                $msgtype  = 'text';
                $content  = '终于等到你！
                感谢关注“优信二手车”作为最大的二手车平台，我们致力于给您最满意的车辆和服务！
                            回复：“优信”';
                $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
                $info     = sprintf($template, $toUser, $fromUser, $time, $msgtype, $content );
                echo $info;
            }

            ////////////////////////////////////////////////////////////////////////////////////////////////

            // 扫码 推送
            if ( strtolower($postObj -> Event) == 'scan' ) {
                // 临时二维码
                if ( $postObj -> EventKey == 2000 ) {
                    $tmp = '欢迎使用临时二维码 再次关注 勿忘初心丶funs';
                }
                // 永久二维码
                if ( $postObj -> EventKey == 3000 ) {
                    $tmp = '欢迎使用永久二维码 再次关注 勿忘初心丶funs';
                }
                $toUser   = $postObj -> FromUserName;
                $fromUser = $postObj -> ToUserName;
                $arr      = array(
                    array(
                        'title'       => $tmp,
                        'description' => '欢迎你使用勿忘初心丶funs',
                        'picUrl'      => 'http://img0.imgtn.bdimg.com/it/u=3480443286,3729707680&fm=206&gp=0.jpg',
                        'url'         => 'http://www.biubiubiu.pub',
                    ),
                );
                $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>". count($arr) ."</ArticleCount>
                            <Articles>";
                foreach ($arr as $k => $v) {
                    $template .="<item>
                            <Title><![CDATA[". $v['title'] ."]]></Title>
                            <Description><![CDATA[". $v['description'] ."]]></Description>
                            <PicUrl><![CDATA[". $v['picUrl'] ."]]></PicUrl>
                            <Url><![CDATA[". $v['url'] ."]]></Url>
                            </item>";
                }
                $template .="</Articles>
                            </xml>";

                $info     = sprintf($template, $toUser, $fromUser, time(), 'news' );
                echo $info;
            }

            // 菜单点击事件推送
            if ( strtolower( $postObj -> Event ) == 'click' ) {
                if ( strtolower( $postObj -> EventKey) == 'phone' ) {

                    $toUser   = $postObj -> FromUserName;
                    $fromUser = $postObj -> toUserName;
                    $time     = time();
                    $msgtype  = 'text';
                    $content  = '咨询请拨打：1010 6088';
                    $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                                </xml>";
                    $info     = sprintf($template, $toUser, $fromUser, $time, $msgtype, $content );
                    echo $info;
                } // 手机推送 end

                if ( strtolower( $postObj -> EventKey ) == 'many' ) {
                    $toUser   = $postObj -> FromUserName;
                    $fromUser = $postObj -> ToUserName;
                    $arr      = array(
                        array(
                            'title'       => '透明、高效的二手车交易',
                            'description' => '透明、高效的二手车交易',
                            'picUrl'      => 'http://img2.imgtn.bdimg.com/it/u=2105715143,1081204671&fm=21&gp=0.jpg',
                            'url'         => 'http://www.youxinpai.com',
                        ),
                        array(
                            'title'       => '新浪微博：“随时随地发现新鲜事”',
                            'description' => '随时随地发现新鲜事',
                            'picUrl'      => 'http://upload.cheaa.com/2014/0609/1402274629915.jpg',
                            'url'         => 'http://www.weibo.com',
                        ),
                        array(
                            'title'       => '一家专门做特卖的网站',
                            'description' => '一家专门做特卖的网站',
                            'picUrl'      => 'http://img3.imgtn.bdimg.com/it/u=3296325597,800384634&fm=21&gp=0.jpg',
                            'url'         => 'http://www.vip.com',
                        ),
                    );
                    $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <ArticleCount>". count($arr) ."</ArticleCount>
                                <Articles>";
                    foreach ($arr as $k => $v) {
                        $template .="<item>
                                <Title><![CDATA[". $v['title'] ."]]></Title>
                                <Description><![CDATA[". $v['description'] ."]]></Description>
                                <PicUrl><![CDATA[". $v['picUrl'] ."]]></PicUrl>
                                <Url><![CDATA[". $v['url'] ."]]></Url>
                                </item>";
                    }
                    $template .="</Articles>
                                 </xml>";

                    $info     = sprintf($template, $toUser, $fromUser, time(), 'news' );
                    echo $info;
                } // 更多咨询 end
            } // 点击事件 end

        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////

        // 图文回复
        if ( strtolower( $postObj -> MsgType ) == 'text' && trim( $postObj -> Content) == '活动' ) {
            $toUser   = $postObj -> FromUserName;
            $fromUser = $postObj -> ToUserName;
            $arr      = array(
                array(
                    'title'       => '【优】质可【信】',
                    'description' => '【优】质可【信】',
                    'picUrl'      => 'http://g4.ykimg.com/0130391F455590A73F4EFD2E815C79E212E7A6-6AC9-D683-6800-7CCF3BD64269',
                    'url'         => 'http://www.xin.com',
                ),
                array(
                    'title'       => '上天猫,就够了',
                    'description' => '上天猫,就够了',
                    'picUrl'      => 'http://img.sj33.cn/uploads/allimg/201401/7-140101223030645.jpg',
                    'url'         => 'http://www.weibo.com',
                ),
                array(
                    'title'       => '又瞎淘了吧?同一低价，买一真的，双十一就上京东',
                    'description' => '又瞎淘了吧?同一低价，买一真的，双十一就上京东',
                    'picUrl'      => 'http://img5.imgtn.bdimg.com/it/u=558632079,3051664574&fm=21&gp=0.jpg',
                    'url'         => 'http://www.jd.com',
                ),
            );
            $template = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<ArticleCount>". count($arr) ."</ArticleCount>
								<Articles>";
            foreach ($arr as $k => $v) {
                $template .="<item>
					            <Title><![CDATA[". $v['title'] ."]]></Title>
								<Description><![CDATA[". $v['description'] ."]]></Description>
								<PicUrl><![CDATA[". $v['picUrl'] ."]]></PicUrl>
								<Url><![CDATA[". $v['url'] ."]]></Url>
								</item>";
            }
            $template .="</Articles>
					             </xml>";

            $info     = sprintf($template, $toUser, $fromUser, time(), 'news' );
            echo $info;

        } else {

            switch ( trim( $postObj -> Content ) ) {
                case '张丽':
                    $content = '懵娜丽傻';
                    break;
                case '王浩':
                    $content = '王浩少年boy（奶棒管够）';
                    break;
                case '徐海超':
                    $content = '徐海超心机boy（套路一波又一波）';
                    break;
                case '张丽逼逼叨':
                    $content = '逼逼叨';
                    break;
                case '哈哈':
                    $content = 'Biubiubiu ~ ~ ';
                    break;
                case '百度':
                    $content = '<a href="http://www.baidu.com">百度一下，你就知道</a>';
                    break;
                case '优信':
                    $content = '【优信二手车】提供全国海量优质二手车源,15天包退,100%真实车源,专业车况检测,精准价格评估,审核严格,绝无事故车,0佣金,可付一半分期买车,金融策略灵活。<a href="http://www.xin.com">【优】质可【信】</a>';
                    break;

            } // 图文回复
            // 回复消息
            $toUser   = $postObj -> FromUserName;
            $fromUser = $postObj -> toUserName;
            $time     = time();
            $msgtype  = 'text';
            $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
            $info     = sprintf($template, $toUser, $fromUser, $time, $msgtype, $content );
            echo $info;

        }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // 天气
        // if (strtolower( $postObj -> MsgType ) == 'text' && trim( $postObj -> Content) == '北京') {
        // $toUser   = $postObj -> FromUserName;
        // $fromUser = $postObj -> ToUserName;
        // $time     = time();

        // $ch     = curl_init();
        // $url    = 'http://apis.baidu.com/apistore/weatherservice/citylist?cityname='. urlencode($postObj -> Content);
        // $header = array(
        //     'apikey: e2b9923663d595ed1a6289781e03d2cc',
        // );
        // // 添加apikey到header
        // curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // // 执行HTTP请求
        // curl_setopt($ch , CURLOPT_URL , $url);
        // $res = curl_exec($ch);
        // $arr = json_encode( $res,true );
        // $content = $arr['retData']['city']. "\n" .
        //            $arr['retData']['date']. "\n" .
        //            $arr['retData']['weather']. "\n" .
        //            $arr['retData']['l_tmp']. "\n" .
        //            $arr['retData']['h_tmp']
        // $infos   = sprintf($template, $toUser, $fromUser, $time, $content );
        // echo $infos;
        // }

    } // 方法reponseMeg end






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
        echo $path;
        header( 'location:'. $path);
    }
    //获取微信公众号的code
    public function get_code(){
        $appId="wx9036c924e93284c6";
        $appSecret="b6ace35d7f3820f253b6c770d6a028e4";
        $code=Request::input('code');
        //通过code获取openid
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code";
        $arr=file_get_contents($url);
        $data=json_decode($arr,true);
        $openid=$data['openid'];
        if($code){
            $time=time();
            DB::table('user')->insert(
                array('datetime' => $time));
        }
    }
}
?>