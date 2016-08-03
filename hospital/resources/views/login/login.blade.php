<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk">
    <meta name="keywords" content="好大夫，好大夫在线">
    <title>用户登录</title>
    <link href="{{URL::asset('/')}}login/base.css" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('/')}}login/main2_0.css" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('/')}}login/newreg.css" rel="stylesheet" type="text/css">
    <script src="{{URL::asset('/')}}login/hm.js">

    </script><script src="{{URL::asset('/')}}login/analytics.js" async=""></script><script type="text/javascript" language="javascript" src="{{URL::asset('/')}}login/jquery-1.js"></script>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/')}}login/top_change.css">
    <script type="text/javascript" src="{{URL::asset('/')}}login/fancybox4login.js"></script><script type="text/javascript" src="{{URL::asset('/')}}login/jquery_002.js"></script>
    <link rel="stylesheet" href="{{URL::asset('/')}}login/jquery.css" type="text/css" media="screen">

    <script src="{{URL::asset('/')}}login/jquery.js"></script>
    <script type="text/javascript" src="{{URL::asset('/')}}login/register_login_new.js"></script>
    <style>
        .readonly {
            background-color:#e4e4e4;
        }
    </style>
</head>
<body>
<div id="topbar_box" class="topbar_box">
    <div class="topbar clearfix">
        <div class="topbar_left"><a class="red" href="http://passport.haodf.com/user/login" rel="nofollow">登录</a><span class="red">|</span><a class="red" href="http://passport.haodf.com/user/register" rel="nofollow">注册</a><span class="grey nologininfo">好大夫在线，帮你找到好大夫</span></div>
        <div class="topbar_right"><a href="http://passport.haodf.com/myfavorite/myfavoritelist" class="grey" rel="nofollow">我的收藏</a>
            <span class="grey">|</span>
            <a class="grey" href="http://www.haodf.com/info/mobile/hdf_mobile.php">手机版</a>
            <span class="grey">|</span>
            <a class="grey" href="http://www.haodf.com/sitemap.html">网站地图</a>
            <span class="grey">|</span>
            <a class="grey" href="http://www.haodf.com/ask/">问答知识库</a>
        </div>
    </div>
</div>
<div class="usertopv1">
    <div class="usertopv1_logo">
        <a href="http://www.haodf.com/"><img src="{{URL::asset('/')}}login/logo.png">
        </a>
        <p class="fl h30 pl10 f-yahei f22">登录</p>
    </div>
</div>

<div class="userlrv1 clearfix">
    <div class="userlrv1_logo fl"><img src="{{URL::asset('/')}}login/lrlogo2.png" style="margin-left:30px;">
    </div>
    <div class="userlrv1_main">
        <div class="pl70 pr70">
            <div class="userlrv1_title lh180 mt40">
                <h5 class="fl blue1 f20 f-yahei">用户登录</h5>
                <div class="fr f12">没有账号？<a href="{{'Userregister'}}" class="blue1">立即注册</a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mt20">
                <div class="slideTxtBox">
                    <div class="hd">
                        <ul>
                            <li class="userlrv1_lg cur">普通登录</li>
                            <li class="u_line"></li>
                            <li class="userlrv1_lg" style="color:#ed0606;position: relative">手机快速登录<img src="{{URL::asset('/')}}login/recommend_icon.png" style="position: absolute;top:2px;right:21px"></li>
                        </ul>
                    </div>
                    <div class="bd">
                        <form action="loginbynormal" method="post" id="loginbynormal">
                            <input name="forward" value="http://passport.haodf.com/index/mycenter" type="hidden">
                            <input name="fromType" value="" type="hidden">
                            <input class="errNotice" value="" type="hidden">
                            <div class="userlrv1_lgbox mt25">
                                <div class="userlrv1_item">
                                    <label for="tel" class="userlrv1_tit">
                                        登录名：
                                    </label>
                                    <div class="userlrv1_i_box">
                                        <input id="tel" class="userlrv1_i_text userName" name="username" type="text">
                                        <div class="userlrv1_tipsbox uname_tipsbox ">用户名/手机号/邮箱</div>
                                        <div class="userlrv1_successbox uname_successbox none"></div>
                                    </div>
                                </div>
                                <div class="userlrv1_errorbox uname_errorbox none">请输入正确的登录名</div>

                                <div class="userlrv1_item mt20">
                                    <label for="pass" class="userlrv1_tit">
                                        登录密码：
                                    </label>
                                    <div class="userlrv1_i_box">
                                        <input id="pass" class="userlrv1_i_text password" name="password" type="password">
                                        <div class="userlrv1_successbox pwd_successbox none"></div>
                                    </div>
                                </div>
                                <div class="userlrv1_errorbox pwd_errorbox  none">请输入正确密码</div>
                                <input name="wrongTimes" value="0" type="hidden">

                                <div class="userlrv1_item mt20">
                                    <label for="pass" class="userlrv1_tit">
                                        验证码：
                                    </label>
                                    <div class="">
                                        <input type="text" name="captcha" id="checkCode" class="form-control" style="height: 40px;">
                                        <img src="{{ URL('kit/captcha/{tmp}') }}" onclick="this.src='{{URL('kit/captcha/{tmp}')}}'+Math.random()"/>
                                        {{--<div class="userlrv1_successbox pwd_successbox none"></div>--}}
                                    </div>
                                </div>
                                <div class="tr mt5">
                                    <a href="https://passport.haodf.com/user/resetpassword" class="blue1 f12">忘记密码？</a>
                                </div>
                                <input type="hidden" name="_token"     id="token"    value="<?php echo csrf_token() ?>"/>
                                <div class="userlrv1_item mt20">
                                    <div class="userlrv1_tit"></div>
                                    <div class="fl w290">
                                        <a href="javascript:;" class="userlrv1_blue_btn f-yahei loginbynormal">登录</a>
                                    </div>
                                </div>
                                <!--第三方登录-->
                                <div class="clearfix">
                                    <a class="fast-login-btn qq-btn" href="#">使用腾讯QQ登录</a>
                                    <a id="wei" style="cursor: pointer;">手机扫一扫登录</a>
                                </div>
                                <div id="erweima" style="display: none;">
                                    {!! QrCode::size(100)->generate(Request::url()); !!}
                                </div>
                                <div class="userlrv1_item mt10">
                                    <div class="userlrv1_tit"></div>
                                    <div class="fl w300 f12 gray3">若登录出现问题，请检查您的浏览器是否禁用了Cookie</div>
                                </div>

                            </div>
                        </form>

                        <form style="display: none;" action="/user/loginbymobilecode" method="post" id="loginbymobilecode" class="none">
                            <input name="forward" value="http://passport.haodf.com/index/mycenter" type="hidden">
                            <div class="userlrv1_lgbox">
                                <div class="userlrv1_item mt25">
                                    <label for="tel" class="userlrv1_tit">
                                        手机号码：
                                    </label>
                                    <div class="userlrv1_i_box">
                                        <input id="tel" class="userlrv1_i_text mobileNumber" name="mobileNumber" type="text">
                                        <!-- <input id="tel" type="text" class="userlrv1_i_text userlrv1_text_error"> -->
                                        <div class="userlrv1_tipsbox mobile_tipsbox ">请输入手机号码</div>
                                        <div class="userlrv1_successbox mobile_successbox none"></div>
                                    </div>
                                </div>
                                <div class="userlrv1_errorbox mobile_errorbox none">请输入正确的手机号码</div>

                                {{--<div class="userlrv1_item mt20 none" id="checkCode1_div" style="display:none;">--}}
                                    {{--<label for="repsw" class="userlrv1_tit">--}}
                                        {{--验证码：--}}
                                    {{--</label>--}}
                                    {{--<div class="userlrv1_i_box2">--}}
                                        {{--<input id="repsw" class="userlrv1_i_text2 checkCode1 " name="checkCode1" type="text">--}}
                                        {{--<input id="registertoken1" name="token1" value="" type="hidden">--}}
                                        {{--<input id="registerCaptchaId1" name="captchaId1" value="" type="hidden">--}}
                                        {{--<div class="userlrv1_successbox userlrv1_successbox2 checkcode_successbox1 none"></div>--}}
                                        {{--<img alt="" class="userlrv1_code" id="registercaptcha1">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="userlrv1_errorbox userlrv1_errorbox2 checkcode_errorbox1 none">验证码不正确</div>
                                <div class="userlrv1_item mt20">
                                    <label for="psw" class="userlrv1_tit">
                                        短信验证码：
                                    </label>
                                    <div class="userlrv1_i_box2">
                                        <input id="psw" class="userlrv1_i_text2 mobileCode" name="mobileCode" type="text">
                                        <div class="userlrv1_successbox userlrv1_successbox2 mobileCode_successbox none"></div>
                                        <a href="javascript:;" class="userlrv1_getcode getMobileCode">获取验证码</a>
                                        <a href="javascript:;" class="reGetMobileCOde none">剩余59秒</a>
                                    </div>
                                    <a class="showUserList fancyBoxUrl none"></a>
                                </div>
                                <div class="userlrv1_errorbox mobileCode_errorbox none">验证码不正确</div>


                                <div class="userlrv1_item mt30">
                                    <div class="userlrv1_tit"></div>
                                    <div class="fl w290">
                                        <a href="javascript:;" class="userlrv1_blue_btn f-yahei loginbymobilecode">登录</a>
                                    </div>
                                </div>

                                <div class="userlrv1_item mt10">
                                    <div class="userlrv1_tit"></div>
                                    <div class="fl w290 f12 gray3">
                                        如果多次未收到验证码，请<a target="_blank" href="http://www.haodf.com/suggestion/suggestion" class="blue1 unl">联系我们</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    var failCnt = 0;
    var times = 5;
    var param = 1;
    //默认的水印开关是关着的
    var isOpened = false;
    //判断水印验证码是否填写正确的变量
    var isNotSuccessVerify = "fail";
    $(function() {
        $(".userlrv1_tipsbox").click(function(){
            $(this).prev("input").focus();
        });
        initFancyBoxHideClick('a.fancyBoxUrl');

        var $errNotice = $.trim($('.errNotice').val());
        if ($errNotice != '')
        {
            //alert($errNotice);
            $('.errNotice').val('');
        }

        changeRegisterVerifyCode();
        $('#registercaptcha').click(function(){
            changeRegisterVerifyCode();
            $('.checkcode_successbox').hide();
            $('.checkcode_errorbox').hide();
        });

        $('#registercaptcha1').click(function(){
            changeLoginVerifyCodeByMobile();
            $('.checkcode_successbox1').hide();
            $('.checkcode_errorbox1').hide();
        });

        var username = $.trim($('.userName').val());
        if (username != '')
        {
            $('.uname_tipsbox').addClass('none');
        }

        var mobileNumber = $.trim($('.mobileNumber').val());
        if (mobileNumber != '')
        {
            $('.mobile_tipsbox').addClass('none');
        }

        var checkCode = $.trim($('.checkCode').val());
        if (checkCode != '')
        {
            $('.checkcode_successbox').hide();
            $('.checkcode_errorbox').hide();
        }
        $(".slideTxtBox").slide({
            titCell: ".hd .userlrv1_lg",
            titOnClassName: "cur",
            mainCell: ".bd",
            trigger: "click"
        });

        $('.userName').focus(function(){
            $('.uname_tipsbox').addClass('none');
            $('.uname_errorbox').addClass('none');
        });
        $('.userName').blur(function(){
            var username = $.trim($('.userName').val());
            if (username == '')
            {
                $('.uname_tipsbox').removeClass('none');
            }
            else
            {
                $('.uname_errorbox').addClass('none');
            }
        });

        $('.password').focus(function(){
            $('.pwd_errorbox').addClass('none');
        });
        $('.password').blur(function(){
            var password = $.trim($('.password').val());
            if (password != '')
            {
                $('.pwd_errorbox').addClass('none');
            }
        });
        $('.checkCode').blur(function(){
            $.post("/user/ajaxcheckverifycode", {verifyStr:$('.checkCode').val(), token:$('#registertoken').val()},function(data){
                if (data !=1)
                {
                    $('.checkcode_errorbox').show();
                    $('.checkcode_successbox').hide();
                    changeRegisterVerifyCode();
                }
                else
                {
                    $('.checkcode_successbox').show();
                    $('.checkcode_errorbox').hide();
                }
            });
        });

        //鼠标放在立即显示扫描二维码
        $("#wei").mouseover(function(){
            $("#erweima").show();
        })
        $("#wei").mouseleave(function(){
            $("#erweima").hide();
        })
        //针对手机登录的时候的水印验证码的触发方法实现
        $('.checkCode1').blur(function(){
            verifyCode();
        });

        //针对手机登录的时候的水印验证码的触发方法
        $('.checkCode1').keyup(function(){
            var checkCode = $('.checkCode1').val();
            if(checkCode.length == 4)
            {
                verifyCode();
            }
        });
        $('.checkCode').keyup(function(){
            var checkCode = $('.checkCode').val();
            if(checkCode.length == 4)
            {
                $.post("/user/ajaxcheckverifycode", {verifyStr:$('.checkCode').val(), token:$('#registertoken').val()},function(data){
                    if (data !=1)
                    {
                        $('.checkcode_errorbox').show();
                        $('.checkcode_successbox').hide();
                        changeRegisterVerifyCode();
                    }
                    else
                    {
                        $('.checkcode_successbox').show();
                        $('.checkcode_errorbox').hide();
                    }
                });
            }
        });
        //判断登录，并且给出提示
        $(".loginbynormal").click(function(){
            var username = $.trim($('.userName').val());
            var password = $.trim($('.password').val());
            var checkCode = $.trim($('#checkCode').val());
            //获取token值
            var token=$("#token").val();
            var url="{{URL('login_do')}}";
            var data={'username':username,'password':password,'checkCode':checkCode,'_token':token};
            $.post(url,data,function(msg){
                alert(msg)
            })
        });

//        $('.loginbynormal').click(function(){
//            var username = $.trim($('.userName').val());
//            var password = $.trim($('.password').val());
//            var checkMobileCode = $.trim($('.checkMobileCode').val());
//
//            var checkCode = $.trim($('.checkCode').val());
//            var mobileCodeForNormal = $('#pswNormal').val();
//            if (!$('#checkCode_div').hasClass('none'))
//            {
//                if ('' == checkCode)
//                {
//                    $('.checkcode_errorbox').show();
//                    return false;
//                }
//                if (!$('.checkcode_errorbox').hasClass('none'))
//                {
//                    $('.checkcode_errorbox').show();
//                    $('.checkcode_successbox').hide();
//                    return false;
//                }
//            }
//
//            if (!$('.checkMobileCode').hasClass('none')) {
//            }
//
//            if (false == isShowErrorTip(username, 'uname_errorbox', '请输入正确的登录名'))
//            {
//                return false;
//            }
//            if( false == isShowErrorTip(password, 'pwd_errorbox', '密码不正确'))
//            {
//                $('.checkcode_successbox').hide();
//                $('.checkcode_errorbox').hide();
//                return false;
//            }
//            if(getUserIdCntByUserName(username, "NORMAL"))
//            {
//                if(false == getUsersByUsername(username, password, checkCode))
//                {
//                    $('#loginbynormal').submit();
//                    return false;
//                }
//                else
//                {
//                    return false;
//                }
//            }
//            else
//            {
//                $('.uname_errorbox').html('用户名不存在');
//                $('.uname_errorbox').removeClass('none');
//            }
//        });
        var checkCode = $.trim($('.checkCode1').val());
        if (checkCode != '')
        {
            $('.checkcode_successbox1').hide();
            $('.checkcode_errorbox1').hide();
        }

        $('.mobileNumber').focus(function(){
            $('.mobile_tipsbox').addClass('none');
            $('.mobile_successbox').addClass('none');
            $('.mobile_errorbox').addClass('none');
        });

        $('.mobileNumber').blur(function(){
            var mobileNumber = $.trim($(this).val());
            if (mobileNumber == '')
            {
                $('.mobile_tipsbox').removeClass('none');
                return false;
            }
            if (!checkmobile(mobileNumber))
            {
                $('.mobile_errorbox').removeClass('none');
                $('.mobile_errorbox').text('请输入正确的手机号');
                return false;
            }
            else
            {
                $('.mobile_successbox').removeClass('none');
            }
        });

        $('.getMobileCode').click(function(){
            var mobileNumber = $.trim($('.mobileNumber').val());
            var token = $.trim($('#registertoken1').val());
            var verify = $.trim($('.checkCode1').val());
            //前端检验手机号格式
            if (!checkMobileNumber(mobileNumber))
            {
                return false;
            }
            if (!getUserIdCntByUserName(mobileNumber, "QUICK"))
            {
                $('.mobile_errorbox').removeClass('none');
                $('.mobile_errorbox').text('该手机号未注册，请注册');
                $('.mobile_successbox').addClass('none');
                return false;
            }
            else
            {
                $('.mobile_successbox').removeClass('none');
            }

            //判断当前的开关是否开着，如果开着同时验证码填写正确的话就是进行发送，如果开关是关着的直接进行发送
            var optType = 'Login';
            $.post(
                    'ajaxsendmobilecode4login',
                    {mobileNumber: mobileNumber, sourceType:optType, token: token, verify: verify},
                    function(res){
                        var code = res.code;
                        if(0 == code)
                        {
                            showTime();
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('<p style="color:#666; font-size:12px">验证码发送成功</p>');
                            $('.mobileCode_errorbox').removeClass('none');
                            return false;
                        }
                        if (40001 == code)
                        {
                            $('.mobile_errorbox').text('请输入正确的手机号');
                            $('.mobile_errorbox').removeClass('none');
                        }
                        else if (40002 == code)
                        {
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('<p style="color:#666; font-size:12px">操作过于频繁，请稍后尝试</p>');
                            $('.mobileCode_errorbox').removeClass('none');
                        }
                        else if (40003 == code)
                        {
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('已发送5次，有问题<a href="http://www.haodf.com/suggestion/suggestion" target="_blank" style="color:#c00;size:14px;text-decoration:underline;">联系我们</a>');
                            $('.mobileCode_errorbox').removeClass('none');
                        }else if (40004 == code)
                        {
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('<p style="color:#666; font-size:12px">亲，操作太频繁了或者已经超过上限</p>');
                            $('.mobileCode_errorbox').removeClass('none');

                        }else if (40005 == code)
                        {
                            $('#checkCode1_div').show();
                            $('.checkcode_errorbox1').show();
                            $('.checkcode_successbox1').hide();
                            changeLoginVerifyCodeByMobile();
                        }else{
                            $('.checkcode_successbox').show();
                            $('.checkcode_errorbox').hide();
                        }
                        return false;
                    },
                    "json"
            );
        });


        $('.mobileCode').keyup(function(){
            var mobileNumber = $.trim($('.mobileNumber').val());
            var mobileCode = $.trim($('.mobileCode').val());
            if (mobileCode.length == 6)
            {
                checkMobileCode(mobileNumber, mobileCode);
            }
        });

        $('.mobileCode').blur(function(){
            var mobileNumber = $.trim($('.mobileNumber').val());
            var mobileCode = $.trim($('.mobileCode').val());
            if (mobileCode.length == 6)
            {
                checkMobileCode(mobileNumber, mobileCode);
            }
        });

        $('.loginbymobilecode').click(function(){
            var mobilecode = $.trim($('.mobileCode').val());
            var mobilenumber = $.trim($('.mobileNumber').val());

            $('.mobile_errorbox').addClass('none');
            $('.mobileCode_errorbox').addClass('none');
            if (mobilenumber == '')
            {
                $('.mobile_errorbox').text('请输入正确的手机号');
                $('.mobile_errorbox').removeClass('none');
                return false;
            }
            if (!checkmobile(mobilenumber))
            {
                $('.mobile_errorbox').text('请输入正确的手机号');
                $('.mobile_errorbox').removeClass('none');
                return false;
            }

            if (mobilecode == '')
            {
                $('.mobileCode_errorbox').text('验证码不正确');
                $('.mobileCode_errorbox').removeClass('none');
                return false;
            }
            if ($('.mobileCode_successbox').hasClass('none'))
            {
                $('.mobileCode_errorbox').text('验证码不正确');
                $('.mobileCode_errorbox').removeClass('none');
                return false;
            }
            $('#loginbymobilecode').submit();
            return false;
        });
        if (0)
        {
            alert('');
        }
        //end

    });

    var waitingSecond = 60;
    function showTime()
    {
            waitingSecond -= 1;
            $('.reGetMobileCOde').html("剩余" + waitingSecond + "秒");
            $('.reGetMobileCOde').addClass('userlrv1_getcode');
            $('.reGetMobileCOde').addClass('userlrv1_getcode_on');
            $('.reGetMobileCOde').removeClass('none');
            if (waitingSecond == 0)
            {
                stopClock();
                return;
            }
            timerID = setTimeout("showTime()",1000);
        }

        function stopClock()
        {
            clearTimeout(timerID);
            waitingSecond = 60;
            $('.reGetMobileCOde').removeClass('userlrv1_getcode');
            $('.reGetMobileCOde').removeClass('userlrv1_getcode_on');
            $('.reGetMobileCOde').addClass('none');
        }

            var waitingSecondNew = 60;
            function showTimeNew()
            {
            waitingSecondNew -= 1;
            $('.reGetMobileCOdeNew').html("剩余" + waitingSecondNew + "秒");
            $('.reGetMobileCOdeNew').addClass('userlrv1_getcode');
            $('.reGetMobileCOdeNew').addClass('userlrv1_getcode_on');
            $('.reGetMobileCOdeNew').removeClass('none');
            if (waitingSecondNew == 0)
            {
                stopClockNew();
                return;
            }
            timerID = setTimeout("showTimeNew()",1000);
        }

                function stopClockNew()
                {
            clearTimeout(timerID);
            waitingSecondNew = 60;
            $('.reGetMobileCOdeNew').removeClass('userlrv1_getcode');
            $('.reGetMobileCOdeNew').removeClass('userlrv1_getcode_on');
            $('.reGetMobileCOdeNew').addClass('none');
        }

                    function getUsersByUsername(username, password, checkcode)
                    {
            var bool = true;
            var token = $("#registertoken").val();
            var captchaid = $("#registerCaptchaId").val();
            $.ajax({
                type:"get",
                    async:false,
                    dataType:'json',
                    url:"/user/ajaxusercnt4username?username="+username+"&password="+password+"&token="+token+"&checkCode="+checkcode+"&captchaid="+captchaid,
                    success:function(data){
                        var cnt = data.cnt;
                        var docFlag = data.docFlag;
                        var resultCode = data.resultCode;
                        var alertMsg = data.alertMsg;
                        var whiteUser = data.whiteUser;
                        if( '1' == docFlag){
                            if('0' == cnt ){
                                if( 0 == whiteUser && 3 == resultCode)
                                {
                                    alert(alertMsg);
                                    $(".slideTxtBox ul li:last").click();
                                    $('#checkCode_div').removeClass('none');
                                    changeRegisterVerifyCode();
                                    $('.checkcode_successbox').hide();
                                    $('.checkcode_errorbox').hide();
                                }
                                else{
                                    if(5 == resultCode){
                                        $('.pwd_errorbox').html('您密码输入错误次数过多，请明天再试');
                                    }
                                    else
                                    {
                                        $('.pwd_errorbox').html('密码不正确');
                                    }
                                    $('.pwd_errorbox').removeClass('none');
                                    failCnt++;
                                    if(failCnt >= 3)
                                    {
                                    $('#checkCode_div').removeClass('none');
                                    changeRegisterVerifyCode();
                                    $('.checkcode_successbox').hide();
                                    $('.checkcode_errorbox').hide();
                                    }
                                }
                            }
                            else if ('1' == cnt || '403' == cnt)
                            {
                                bool = false;
                            }
                            else
                            {
                                if( 0 == whiteUser && 3 == resultCode)
                                {
                                    alert(alertMsg);
                                    $(".slideTxtBox ul li:last").click();
                                }
                                else
                                {
                                    var forward = 'http%3A%2F%2Fpassport.haodf.com%2Findex%2Fmycenter';
                                    $('.showUserList').attr('href', 'ajaxgetusersbyusername?username='+username+'&password='+password+'&token='+token+'&checkCode='+checkcode+'&forward='+forward);
                                    $('.showUserList').click();
                                }
                            }
                        }else{
                            if( '0' == cnt)
                            {
                                failCnt++;
                                if(failCnt >= 3)
                                {
                                    $('#checkCode_div').removeClass('none');
                                }
                                $('.pwd_errorbox').html('密码不正确');
                                $('.pwd_errorbox').removeClass('none');
                                changeRegisterVerifyCode();
                                $('.checkcode_successbox').hide();
                                $('.checkcode_errorbox').hide();
                            }
                            else if ('1' == cnt || '403' == cnt)
                            {
                                bool = false;
                            }
                            else
                            {
                                var forward = 'http%3A%2F%2Fpassport.haodf.com%2Findex%2Fmycenter';
                                $('.showUserList').attr('href', 'ajaxgetusersbyusername?username='+username+'&password='+password+'&token='+token+'&checkCode='+checkcode+'&forward='+forward);
                                $('.showUserList').click();
                            }
                        }
                    }});
                return bool;
        }

                        function getUsersByMobile(mobileNumber, mobileCode)
                        {
            $.getJSON('ajaxusercnt4mobile', {mobileNumber: mobileNumber}, function(data){
                if( 0 == data)
                {
                    failCnt++;
                    if(failCnt >= 3)
                    {
                        //验证码
                        $('#checkCode_div').show();
                    }
                }
                else if (1 == data)
                {
                    return false;
                }
                else
                {
                    var sourceType = 'Login';
                    var forward = 'http%3A%2F%2Fpassport.haodf.com%2Findex%2Fmycenter';
                    $('.showUserList').attr('href',
                        'ajaxgetusersbymobile?mobileNumber='+mobileNumber+'&mobileCode='+mobileCode+'&sourceType='+sourceType+'&forward='+forward);
                    $('.showUserList').click();
                }
            });
        }

                            function checkMobileNumber(mobileNumber)
                            {
            if (mobileNumber.length == 0)
            {
                $('.mobile_tipsbox').removeClass('none');
                $('.mobile_errorbox').removeClass('none');
                return false;
            }
            if (!checkmobile(mobileNumber))
            {
                $('.mobile_errorbox').removeClass('none');
                return false;
            }
            else
            {
                $('.mobile_succesbox').removeClass('none');
                return true;
            }
        }

                                function checkMobileCode(mobileNumber, mobileCode)
                                {
            checkMobileNumber(mobileNumber);
            if (mobileCode.length != 6)
            {
                $('.mobileCode_successbox').addClass('none');
                $('.mobileCode_errorbox').text('验证码不正确');
                $('.mobileCode_errorbox').removeClass('none');
                return false;
            }
            $.post('ajaxcheckmobilecode', {mobileNumber: mobileNumber, mobileCode: mobileCode, sourceType: 'Login'}, function(res){
                if (res)
                {
                    $('.mobileCode_successbox').removeClass('none');
                    $('.mobileCode_errorbox').addClass('none');
                    getUsersByMobile(mobileNumber, mobileCode);
                }
                else
                {
                    $('.mobileCode_successbox').addClass('none');
                    $('.mobileCode_errorbox').text('验证码不正确');
                    $('.mobileCode_errorbox').removeClass('none');
                }
            });
        }

                                    function changeRegisterVerifyCode()
                                    {
        $.post("/user/ajaxchangeverifycode",function(data) {
            var newToken=data['token'];
            var newCid=data['captchaId'];
            $('.checkcode_successbox').hide();
            $('.checkcode_errorbox').hide();
            $("#registercaptcha").attr('src', "/captcha.php?type=login&width=100&height=38&size=20&token="+newToken);
            $("#registertoken").val(newToken);
            $("#registerCaptchaId").val(newCid);
            $(".checkCode").val('');
        },"json");
    }

                                        function changeLoginVerifyCodeByMobile()
                                        {
            $.post("/user/ajaxchangeverifycode",function(data) {
                var newToken=data['token'];
                var newCid=data['captchaId'];

                $('.checkcode_successbox').hide();
                $('.checkcode_errorbox').hide();
                $("#registercaptcha1").attr('src', "/captcha.php?type=login&width=100&height=38&size=20&token="+newToken);
                $("#registertoken1").val(newToken);
                $("#registerCaptchaId1").val(newCid);
                $(".checkCode1").val('');
            },"json");
        }

                                            function getUserIdCntByUserName(username, type)
                                            {
            var bool = true;
            $.ajax({
            url:'ajaxuseridcnt4name?username='+username+'&type='+type,
            async: false,
            success: function(data)
            {
                if( 0 == data)
                {
                    bool = false;
                }
                else
                {
                    bool = true;
                }
            }});
            return bool;
        }

                                                function isShowErrorTip(str, className, strTip)
                                                {
            if (str == '')
            {
                $('.'+className).html(strTip);
                $('.'+className).removeClass('none');
                return false;
            }
            else
            {
                $('.'+className).html('');
                $('.'+className).addClass('none');
                return true;
            }
        }

                                                    function verifyCode()
                                                    {
                                                        $.post("/user/ajaxcheckverifycode", {verifyStr:$('.checkCode1').val(), token:$('#registertoken1').val()},function(data){
                                                            if (data !=1)
                                                            {
                                                                $('.checkcode_errorbox1').show();
                                                                $('.checkcode_successbox1').hide();
                                                                changeLoginVerifyCodeByMobile();
                                                                isNotSuccessVerify = "fail";
                                                            }
                                                            else
                                                            {
                                                                $('.checkcode_successbox1').show();
                                                                $('.checkcode_errorbox1').hide();
                                                                isNotSuccessVerify = "success";
                                                            }
                                                        });
                                                    }
</script>

<table class="table_white" style="margin:0 auto;" align="center" cellpadding="0" cellspacing="0" width="960">
    <tbody><tr>
        <td align="center">
            <table align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" width="960">
                <tbody><tr>
                    <td align="center">
                        <hr>提示：任何关于疾病的建议都不能替代执业医师的面对面诊断。所有门诊时间仅供参考，最终以医院当日<span onclick="document.location.href='http://hdfadmin.haodf.com/purge.php?method=forward&amp;url='+escape(document.location.href)">公布</span>为准。网友、医生言论仅代表其个人观点，不代表本站同意其说法，请谨慎参阅，本站不承担由此引起的法律责任。</td>
                </tr>
                <tr>
                    <td align="center" height="80">
                        <a href="http://www.haodf.com/info/aboutus.php" rel="nofollow">关于好大夫</a>&nbsp;|
                        <a href="http://www.haodf.com/sitemap.html">网站地图</a>&nbsp;|
                        <a href="http://zixun.haodf.com/">咨询好大夫</a>&nbsp;|
                        <a href="http://www.haodf.com/info/contactus.php" rel="nofollow">联系好大夫网站</a>&nbsp;|
                        <a href="http://www.haodf.com/suggestion/suggestion" class="blue" rel="nofollow">意见和建议</a>&nbsp;|
                        <a href="http://www.haodf.com/iphone/index.htm" rel="nofollow">手机版</a>&nbsp;|
                        <a href="http://www.haodf.com/info/hz.php" rel="nofollow">合作联盟</a>&nbsp;|
                        <a href="http://www.haodf.com/info/job.php" class="blue" rel="nofollow">诚聘英才</a>&nbsp;|
                        <a href="http://www.haodf.com/info/eula.php" rel="nofollow">内容管理声明</a>/<a href="http://www.haodf.com/info/copyrights.php" rel="nofollow">版权</a>&nbsp;|
                        <a href="http://www.haodf.com/haiwai" rel="nofollow">出国看病</a>&nbsp;|
                        <a href="http://m.haodf.com/app" rel="nofollow" style="text-decoration:none;">好大夫在线</a>客户端&nbsp;
                        <br>
                        北京市公安局朝阳分局备案编号：11010502030429
                        <a href="http://www.haodf.com/info/icp_auth.php" target="_blank" rel="nofollow">京ICP证080340号</a> <a href="http://www.miibeian.gov.cn/" target="_blank" rel="nofollow">京ICP备06057344号</a> <a href="http://www.haodf.com/info/wsj_auth.php" target="_blank" rel="nofollow">京卫网审[2013]第0092号</a> <a href="http://www.haodf.com/info/bbs_auth.php" target="_blank" rel="nofollow">电信业务审批[2008]字第213号</a>
                        <br>好大夫在线版权所有 Copyright 2016				</td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
<div style="display:none;">
    <script type="text/javascript">
        var protocol = document.location.protocol;
        if(protocol == 'https:')
        {
            document.writeln("<script type='text/javascript' src='/js/base.js?20140717'><"+"/script>");
            document.writeln("<script type='text/javascript' src='/my/js/jquery_framework_4login.4a1daa26.js'><"+"/script>");
        }
        else
        {
            document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/base.js?20140717'><"+"/script>");
            document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/my/js/jquery.framework.min.js?201107151'><"+"/script>");
        }
        var urlprefix = '';
    </script><script type="text/javascript" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/base.js"></script>
    <script type="text/javascript" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/jquery_framework_4login.js"></script>

</div>
<div id="abc"></div>
<script type="text/javascript">
    var protocol = document.location.protocol;
    if(protocol == 'https:')
    {
        document.writeln("<script type='text/javascript' src='/js/pvstat.js?20151209'><"+"/script>");
    }
    else
    {
        document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/pvstat.js?20151209'><"+"/script>");
    }
</script><script type="text/javascript" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/pvstat.js"></script><img style="display:none;" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/pvstat.gif" height="1" width="1">

<script type="text/javascript">
    var protocol = document.location.protocol;
    if(protocol == 'https:')
    {
        //document.writeln("<script type='text/javascript' src='/js/login_bar.fc9ffce6.js'><"+"/script>");
        document.writeln("<script type='text/javascript' src='/js/login_bar_new.js'><"+"/script>");
    }
    else
    {
        //document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/login_bar.fc9ffce6.js'><"+"/script>");
        document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/login_bar_new.js'><"+"/script>");
    }
</script><script type="text/javascript" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/login_bar_new.js"></script>

<div style="display:none">
    <script type="text/javascript">
        var _protocol = document.location.protocol;
        if(_protocol == 'https:')
        {
            document.writeln("<script type='text/javascript' src='https://s84.cnzz.com/stat.php?id=1915189&web_id=1915189'><"+"/script>");
        }
        else
        {
            document.writeln("<script type='text/javascript' src='http://s84.cnzz.com/stat.php?id=1915189&web_id=1915189'><"+"/script>");
        }
    </script><script type="text/javascript" src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/stat.php"></script><script src="%E7%94%A8%E6%88%B7%E7%99%BB%E5%BD%95_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1915189" target="_blank" title="站长统计">站长统计</a>

</div>



<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div></body></html>