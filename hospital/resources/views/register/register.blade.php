<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk">
    <title>用户手机注册-好大夫在线</title>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/')}}register/base.css">
    <link href="{{URL::asset('/')}}register/newreg.css" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('/')}}register/top_change.css" rel="stylesheet" type="text/css">
    <script src="{{URL::asset('/')}}register/hm.js"></script><script src="{{URL::asset('/')}}register/analytics.js" async=""></script>
    <script type="text/javascript" language="javascript" src="{{URL::asset('/')}}register/jquery-1.js"></script>
    <script type="text/javascript" src="{{URL::asset('/')}}register/fancybox4login.js"></script>
    <script type="text/javascript" src="{{URL::asset('/')}}register/jquery.js"></script>
    <link rel="stylesheet" href="{{URL::asset('/')}}register/jquery.css" type="text/css" media="screen">

    <script type="text/javascript" src="{{URL::asset('/')}}register/register_login_new.js"></script>
    <script language="javascript">
        var isNotSuccessVerify = "fail";
        var isOpened = false;

        $(document).ready( function() {
            $(".userlrv1_tipsbox").click(function(){
                $(this).prev("input").focus();
            });
            initFancyBoxHideClick('a.fancyBoxUrl');

            var mobileNumber = $.trim($('.mobileNumber').val());
            if (mobileNumber != '')
            {
                $('.mobileNumber_tipsbox').addClass('none');
            }

            //判断只有水印开关开着的时候才可以获取验证码
            if (isOpened)
            {
                changeLoginVerifyCodeByMobile();
                $('#checkCode1_div').show();
            }
            else
            {
                $('#checkCode1_div').hide();
            }

            $('#registercaptcha1').click(function(){
                changeLoginVerifyCodeByMobile();
                $('.checkcode_successbox1').hide();
                $('.checkcode_errorbox1').hide();
            });


            var checkCode = $.trim($('.checkCode1').val());
            if (checkCode != '')
            {
                $('.checkcode_successbox1').hide();
                $('.checkcode_errorbox1').hide();
            }

            $('.mobileNumber').focus(function(){
                $('.mobileNumber_tipsbox').addClass('none');
                $('.mobileNumber_succesbox').addClass('none');
                $('.mobileNumber_errorbox').addClass('none');
            });

            $('.mobileNumber').blur(function(){
                var mobileNumber = $.trim($('.mobileNumber').val());
                if ('' != mobileNumber)
                {
                    checkMobileNumber(mobileNumber);
                }
                else
                {
                    $('.mobileNumber_tipsbox').removeClass('none');
                }
            });

            $('#registercaptcha1').click(function(){
                changeRegisterVerifyCodeByMobile();
                $('.checkcode_successbox1').hide();
                $('.checkcode_errorbox1').hide();
            });

            $('.checkCode1').blur(function(){
                verifyCode();
            });

            $('.checkCode1').keyup(function(){
                var checkCode = $('.checkCode1').val();
                if(checkCode.length == 4)
                {
                    verifyCode();
                }
            });

            var checkCode = $.trim($('.checkCode1').val());
            if (checkCode != '')
            {
                $('.checkcode_successbox1').hide();
                $('.checkcode_errorbox1').hide();
            }

            $('.getMobileCode').click(function(){
                var mobileNumber = $.trim($('.mobileNumber').val());
                var token = $.trim($('#registertoken1').val());
                var verify = $.trim($('.checkCode1').val());
                var optType = 'Register';
                if (!checkmobile(mobileNumber))
                {
                    $('.mobileNumber_errorbox').removeClass('none');
                    return false;
                }
                else
                {
                    $('.mobileNumber_succesbox').removeClass('none');
                }

                if ($('#checkCode1_div').hasClass('none'))
                {
                    if ('' == verify && isOpened)
                    {
                        $('.checkcode_errorbox1').show();
                        $('.checkcode_success1').hide();
                        return false;
                    }
                }
                //判断当前的开关是否开着，如果开着同时验证码填写正确的话就是进行发送，如果开关是关着的直接进行发送
                if ((isNotSuccessVerify == "success" && isOpened) || false == isOpened)
                {
                    $.post('ajaxcheckmobilesend', {mobileNumber: mobileNumber, sourceType:optType}, function(data){
                        if (data == 'succ')
                        {
                            $.post('ajaxsendmobilecode', {mobileNumber: mobileNumber, token: token, verify: verify}, function(res){
                                if ("error" == res)
                                {
                                    $('.mobileCode_errorbox').html('');
                                    $('.mobileCode_errorbox').html('<p style="color:#666; font-size:12px">亲，操作太频繁了或者超过了我们的上限</p>');
                                    $('.mobileCode_errorbox').removeClass('none');
                                }
                                else
                                {
                                    showTime();
                                    $('.mobileCode').blur();
                                    $('.mobileCode_errorbox').html('');
                                    $('.mobileCode_errorbox').html('验证码发送成功');
                                    $('.mobileCode_errorbox').removeClass('none');
                                }
                            });
                        }
                        else if (data == 'frequent')
                        {
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('操作过于频繁，请稍后尝试');
                            $('.mobileCode_errorbox').removeClass('none');
                        }
                        else if (data == 'toomuch')
                        {
                            $('.mobileCode_errorbox').html('');
                            $('.mobileCode_errorbox').html('已发送5次，有问题<a href="http://www.haodf.com/suggestion/suggestion" target="_blank" style="color:#c00;text-decoration:underline;">联系我们</a>');
                            $('.mobileCode_errorbox').removeClass('none');
                        }
                    });
                }

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
                else
                {
                    $('.mobileCode_successbox').addClass('none');
                    $('.mobileCode_errorbox').html('短信验证码不正确');
                    $('.mobileCode_errorbox').removeClass('none');
                }
            });

            $('.password').focus(function(){
                $('.pwd_tipsbox').addClass('none');
            });

            $('.password').blur(function(){
                var pwd = $.trim($('.password').val());
                if(pwd.length == 0)
                {
                    $('.pwd_tipsbox').removeClass('none');
                    $('.pwd_errorbox').text('密码必须是6-20位字母、数字或字符');
                    $('.pwd_errorbox').addClass('none');
                }
            });
            $('.password').keyup(function(){
                var pwd = $.trim($('.password').val());
                var mobileNumber = $.trim($('.mobileNumber').val());
                if (pwd.length != 0 )
                {
                    checkPassword(mobileNumber, pwd);
                }
                else
                {
                    $('.pwd_successbox').addClass('none');
                }
            });
            $('.userlrv1_checkbox').click(function(){
                $(this).toggleClass('userlrv1_checkbox_on');
            });

            $('.registerByMobile').click(function(){
                var mobileNumber = $.trim($('.mobileNumber').val());
                var pwd  = $.trim($('.password').val());
                var forward  = $.trim($('.forward').val());
                if ($('.mobileNumber_succesbox').hasClass('none'))
                {
                    $('.mobileNumber_errorbox').removeClass('none');
                    return false;
                }
                if ($('.mobileCode_successbox').hasClass('none'))
                {
                    $('.mobileCode_errorbox').removeClass('none');
                    return false;
                }
                if ($('.pwd_successbox').hasClass('none'))
                {
                    $('.pwd_errorbox').removeClass('none');
                    return false;
                }
                if (!$('.userlrv1_checkbox').hasClass('userlrv1_checkbox_on'))
                {
                    $('.readme_on').show();
                    return false;
                }
                else
                {
                    $('.readme_on').hide();
                }
                if(checkIsWeakPassword())
                {
                    return false;
                }
                $('.regByMobileForm').submit();
                return false;
            });

            $('.userlrv1_helpico').mouseover(function(){
                $('.userlrv1_helpcon').show();
            });

            $('.userlrv1_helpico').mouseout(function(){
                $('.userlrv1_helpcon').hide();
            });
        });




    }



                        //使验证码变换的方法
                        function changeLoginVerifyCodeByMobile()
                        {
                            $.post("/user/ajaxchangeverifycode",function(data) {
                                var newToken=data['token'];
                                var newCid=data['captchaId'];

                                $("#registercaptcha1").attr('src', "/captcha.php?type=login&width=100&height=38&size=20&token="+newToken);
                                $("#registertoken1").val(newToken);
                                $("#registerCaptchaId1").val(newCid);
                                $(".checkCode1").val('');
                            },"json");
                        }

                        //该方法就是用来将水印验证码的触发方法的主体合并成一个方法的
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
                            $('.getMobileCode').html('重新获取');
                        }

                        function checkIsWeakPassword()
                        {
                            var isWeakPwd = false;
                            var pwd = $.trim($('.password').val());
                            $.ajax({url:'checkweakpassword?password='+pwd,
                                async:false,
                                success:function(data){
                                    if (data == '0')
                                    {
                                        $('.pwd_successbox').addClass('none');
                                        $('.pwd_errorbox').text('密码过于简单');
                                        $('.pwd_errorbox').removeClass('none');
                                        isWeakPwd = true;
                                    }
                                }});
                            return isWeakPwd;
                        }
    </script>
</head>
<body><div id="topbar_box" class="topbar_box">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/')}}register/top_change.css">
    <div class="topbar clearfix"><div class="topbar_left">
            <a class="red" href="http://passport.haodf.com/user/login">登录</a><span class="red">|</span>
            <a class="red" href="http://passport.haodf.com/user/register">注册</a><span class="grey nologininfo">好大夫在线，帮你找到好大夫</span>
        </div>
        <div class="topbar_right"><a class="grey" href="http://passport.haodf.com/user/login">我的收藏</a><span class="grey">|</span><a class="grey" href="http://www.haodf.com/iphone/index.htm?from=indextop">手机版</a><span class="grey">|</span><a class="grey" href="http://www.haodf.com/sitemap/index.htm">网站地图</a></div></div></div>
<div class="usertopv1">
    <div class="usertopv1_logo">
        <a href="http://www.haodf.com/"><img src="{{URL::asset('/')}}register/logo.png"> </a>
        <p class="fl h30 pl10 f-yahei f22">注册好大夫账号</p>
    </div>
</div>
<div class="userlrv1 clearfix">
    <div class="userlrv1_logo fl"><img src="{{URL::asset('/')}}register/reg_banner.png" class="ml30"> </div>
    <div class="userlrv1_main">
        <div class="pl70 pr70">
            <div class="userlrv1_title lh180 mt40">
                <h5 class="fl blue1 f20 f-yahei">用户注册</h5>
                <div class="fr f12">有账号？直接<a href="{{'Userlogin'}}" class="blue1">登录</a></div>
                <div class="clear"></div>
            </div>

            <form action="registerbymobile" method="post" class="regByMobileForm">
                <input name="forward" class="forward" value="http://passport.haodf.com/index/mycenter" type="hidden">
                <input name="fromType" value="" type="hidden">
                <div class="userlrv1_item mt40">
                    <input class="error" value="" type="hidden">
                    <label for="tel" class="userlrv1_tit">
                        手机号码：
                    </label>
                    <div class="userlrv1_i_box">
                        <input id="tel" class="userlrv1_i_text mobileNumber" name="mobileNumber" type="text">
                        <!-- <input id="tel" type="text" class="userlrv1_i_text userlrv1_text_error"> -->
                        <div class="userlrv1_tipsbox mobileNumber_tipsbox">手机号可用来登录，不对外公开</div>
                        <div class="userlrv1_successbox mobileNumber_succesbox none"></div>
                    </div>
                </div>
                <div class="userlrv1_errorbox mobileNumber_errorbox none">请输入正确的手机号码</div>

                <div class="userlrv1_item mt20 none" id="checkCode1_div" style="display:none;">
                    <label for="psw" class="userlrv1_tit">
                        验证码：
                    </label>
                    <div class="userlrv1_i_box2">
                        <input id="psw" class="userlrv1_i_text2 checkCode1 " name="checkCode1" type="text">
                        <input id="registertoken1" name="token1" value="" type="hidden">
                        <input id="registerCaptchaId1" name="captchaId1" value="" type="hidden">
                        <div class="userlrv1_successbox userlrv1_successbox2 checkcode_successbox1 none"></div>
                        <img alt="" class="userlrv1_code" id="registercaptcha1">
                    </div>
                </div>
                <div class="userlrv1_errorbox userlrv1_errorbox2 checkcode_errorbox1 none">验证码不正确</div>
                <div class="userlrv1_item mt20">
                    <label for="psw" class="userlrv1_tit">
                        短信验证码：
                    </label>
                    <div class="userlrv1_i_box2">
                        <input id="psw" class="userlrv1_i_text2 mobileCode" name="mobileCode" type="text">
                        <!-- <input id="psw" type="text" class="userlrv1_i_text2 userlrv1_text_error"> -->
                        <input style="display:none"><!-- for disable autocomplete on chrome -->
                        <div class="userlrv1_successbox userlrv1_successbox2 mobileCode_successbox none"></div>
                        <a href="javascript:;" class="userlrv1_getcode getMobileCode">获取验证码</a>
                        <a href="javascript:;" class="none reGetMobileCOde ">剩余59秒</a>
                        <a class="showUserList fancyBoxUrl none"></a>
                    </div>
                </div>
                <div class="userlrv1_errorbox  mobileCode_errorbox none">短信验证码不正确</div>

                <div style="position:relative;z-index:5;">
                    <div class="userlrv1_item mt20">
                        <label for="psw" class="userlrv1_tit">
                            设置密码：
                        </label>
                        <div class="userlrv1_i_box" style="z-index:3;">
                            <input id="psw" class="userlrv1_i_text password" name="password" type="password">
                            <!-- <input id="psw" type="password" class="userlrv1_i_text userlrv1_text_error"> -->
                            <div class="userlrv1_tipsbox pwd_tipsbox">6-20位字母、数字、字符</div>
                            <div class="userlrv1_successbox pwd_successbox none"></div>
                        </div>
                    </div>
                    <div class="userlrv1_errorbox pwd_errorbox none">密码必须是6-20位字母、数字或字符</div>
                    <div class="userlrv1_helpbox" style="right:-20px;top:10px;">
                        <div class="userlrv1_helpico"></div>
                        <div class="userlrv1_helpcon none">
                            <div class="h_c_arrow"></div>
                            <p class="red">为了您的帐户安全，密码过于简单将不能注册成功！</p>
                            <b>什么是过于简单密码？</b><br>
                            如：111111、123456、用户名等。<br>
                            <b>强烈建议您在设置密码时注意以下几点：</b><br>
                            1.不要使用自己的公开信息作为密码，如生日、电话、用户名等。<br>
                            2.最好使用数字和字母的组合。
                        </div>
                    </div>
                </div>

                <div class="userlrv1_item" style="font-size:12px;line-height:38px;">
                    <div class="userlrv1_tit"></div>
                    <input name="readMe" checked="checked" type="hidden">
                    <div class="userlrv1_checkbox userlrv1_checkbox_on"><span></span></div>我已阅读并同意<a href="http://info.haodf.com/info/serviceterms.php" target="_blank" class="blue1">《好大夫在线服务协议》</a>
                </div>
                <div class="userlrv1_errorbox readme_on none">您未同意服务条款</div>

                <div class="userlrv1_item mt10">
                    <div class="userlrv1_tit"></div>
                    <div class="fl w290">
                        <a href="javascript:;" class="userlrv1_blue_btn f-yahei registerByMobile">注册</a>
                    </div>
                </div>
            </form>

            <div class="userlrv1_item gray3 mt10 f12">
                <div class="userlrv1_tit"></div>
                如果遇到问题，请<a class="gray3 unl" href="http://www.haodf.com/suggestion/suggestion" target="_blank">联系我们</a>。您还可以<a href="https://passport.haodf.com/user/showregisterbyemail?fromType=&amp;forward=http://passport.haodf.com/index/mycenter" class="blue1">邮箱注册</a>
            </div>
        </div>
    </div>
</div>
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
            document.writeln("<script type='text/javascript' src='{{URL::asset('/')}}register/base.js?20140717'><"+"/script>");
            document.writeln("<script type='text/javascript' src='{{URL::asset('/')}}register/jquery_framework_4login.4a1daa26.js'><"+"/script>");
        }
        else
        {
            document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/base.js?20140717'><"+"/script>");
            document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/my/js/jquery.framework.min.js?201107151'><"+"/script>");
        }
        var urlprefix = '';
    </script><script type="text/javascript" src="{{URL::asset('/')}}register/base.js"></script>
    <script type="text/javascript" src="{{URL::asset('/')}}register/jquery_framework_4login.js"></script>

</div>
<div id="abc"></div>
<script type="text/javascript">
    var protocol = document.location.protocol;
    if(protocol == 'https:')
    {
        document.writeln("<script type='text/javascript' src='{{URL::asset('/')}}register/pvstat.js?20151209'><"+"/script>");
    }
    else
    {
        document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/pvstat.js?20151209'><"+"/script>");
    }
</script><script type="text/javascript" src="{{URL::asset('/')}}register/pvstat.js"></script><img style="display:none;" src="%E7%94%A8%E6%88%B7%E6%89%8B%E6%9C%BA%E6%B3%A8%E5%86%8C-%E5%A5%BD%E5%A4%A7%E5%A4%AB%E5%9C%A8%E7%BA%BF_files/pvstat.gif" height="1" width="1">


<script type="text/javascript">
    var protocol = document.location.protocol;
    if(protocol == 'https:')
    {
        document.writeln("<script type='text/javascript' src='/js/login_bar.fc9ffce6.js'><"+"/script>");
    }
    else
    {
        document.writeln("<script type='text/javascript' src='http://i1.hdfimg.com/js/login_bar.fc9ffce6.js'><"+"/script>");
    }
</script><script type="text/javascript" src="{{URL::asset('/')}}register/login_bar.js"></script>




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
    </script><script type="text/javascript" src="{{URL::asset('/')}}register/stat.php"></script>
    <script src="{{URL::asset('/')}}register/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1915189" target="_blank" title="站长统计">站长统计</a>

</div>

<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div></body></html>