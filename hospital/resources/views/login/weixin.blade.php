<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

</head>
<body>
<?php
    print_r($news);
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
    wx.checkJsApi({
        jsApiList: [
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ],
        success: function (res) {
            alert(JSON.stringify(res));
        }
    });

    wx.ready(function () {
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
            }
        });

        

    });


    wx.onMenuShareTimeline({
        title: '<?php echo $news['Title'];?>',
        link: '<?php echo $news['Url'];?>',
        imgUrl: '<?php echo $news['PicUrl'];?>',
        success: function (res) {
            alert('已分享');
        },
        cancel: function (res) {
            alert('已取消');
        }
    });

</script>
</body>
</html>