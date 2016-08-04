<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<?php
    print_r($news);
?>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage['appId'];?>',
        timestamp: '<?php echo $signPackage["timestamp"];?>',
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'checkJsApi',
            'openLocation',
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '', // 分享标题
            link: '', // 分享链接
            imgUrl: '', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
</body>
</html>