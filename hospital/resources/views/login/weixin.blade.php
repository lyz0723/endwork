<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<?php echo $signPackage['appId']?>
{{--<script>--}}
    {{--wx.config({--}}
        {{--debug: false,--}}
        {{--appId: '<?php echo $signPackage->appId;?>',--}}
        {{--timestamp: <?php echo $signPackage["timestamp"];?>,--}}
        {{--nonceStr: '<?php echo $signPackage["nonceStr"];?>',--}}
        {{--signature: '<?php echo $signPackage["signature"];?>',--}}
        {{--jsApiList: [--}}
            {{--// 所有要调用的 API 都要加到这个列表中--}}
            {{--'checkJsApi',--}}
            {{--'openLocation',--}}
            {{--'getLocation',--}}
            {{--'onMenuShareTimeline',--}}
            {{--'onMenuShareAppMessage'--}}
        {{--]--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>