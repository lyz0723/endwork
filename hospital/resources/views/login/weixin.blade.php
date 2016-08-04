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
            'chooseImage'
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
        //拍照或从手机相册中选图接口
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            }
        });
    });




//获取“分享到朋友圈”按钮点击状态及自定义分享内容接口


</script>
</body>
</html>