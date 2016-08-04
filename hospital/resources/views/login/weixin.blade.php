<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

</head>
<body>

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
                _shareAppMessage();
            }
        });

    });

    function _shareAppMessage() {
        // 页面加载后设置微信分享给朋友的内容
        wx.onMenuShareAppMessage({
            title: '圣诞老人送礼啦，现金红包人人领！', // 分享标题
            desc: '“圣诞夺包”35000份礼包等你拆！', // 分享描述
            link: encodeURI(curDomain + '/christmas/service/ChristmasSockOnline.home.do?area=cd'),//encodeURI(window.location.href.replace('&from=ad', '')), // 分享链接
            imgUrl: url + '/public/christmas/img/shorejoin.jpg', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                //Message.toast.success("分享成功！").appear();
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                //alert('cancel');
            }
        });
    }


</script>
</body>
</html>