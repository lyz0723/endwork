<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

</head>
<body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage['appId'];?>',
        timestamp: '<?php echo $signPackage["timestamp"];?>',
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQZone'
        ]
    });

    wx.ready(function () {
        //享到朋友圈
        wx.onMenuShareTimeline({
            title: '<?php echo $news['Title'];?>',
            link: '<?php echo $news['Url'];?>',
            imgUrl: '<?php echo $news['PicUrl'];?>',
            success: function () {
                alert('已分享');
            },
            cancel: function () {
                alert('已取消');
            }
        });
        //分享给朋友
        wx.onMenuShareAppMessage({
            title: '<?php echo $news['Title'];?>', // 分享标题
            desc: '<?php echo $news['Description'];?>', // 分享描述
            link: '<?php echo $news['Url'];?>', // 分享链接
            imgUrl: '<?php echo $news['PicUrl'];?>', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                alert('已分享');
            },
            cancel: function () {
                alert('已取消');
            }
        });
        //分享到QQ空间
        wx.onMenuShareQZone({
            title: '<?php echo $news['Title'];?>', // 分享标题
            desc: '<?php echo $news['Description'];?>', // 分享描述
            link: '<?php echo $news['Url'];?>', // 分享链接
            imgUrl: '<?php echo $news['PicUrl'];?>', // 分享图标
            success: function () {
                alert('已分享');
            },
            cancel: function () {
                alert('已取消');
            }
        });
    });






</script>
</body>
</html>