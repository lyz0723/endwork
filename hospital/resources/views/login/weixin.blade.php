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
                'onMenuShareQZone',
                'openLocation',
                'getLocation'

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
        //使用微信内置地图查看位置接口
        wx.openLocation({
            latitude: 0, // 纬度，浮点数，范围为90 ~ -90
            longitude: 0, // 经度，浮点数，范围为180 ~ -180。
            name: '北京八维研修学院', // 位置名
            address: '北京市海淀区软件园南', // 地址详情说明
            scale: 2, // 地图缩放级别,整形值,范围从1~28。默认为最大
            infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
        });
        //获取地理位置接口
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






</script>
</body>
</html>