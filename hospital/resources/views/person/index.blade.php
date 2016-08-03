<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <style>

    </style>
</head>
<frameset rows="76,*" framespacing="0" border="1">
    <frame src="{{URL('top')}}" id="top-frame" name="top" frameborder="no" scrolling="no">
    <frameset cols="180, *" framespacing="0" border="1" id="frame-body">
        <frame src="{{URL('menu')}}" id="left-frame" name="left" frameborder="yes" scrolling="yes">

        <frameset rows="70%" framespacing="0" border="1">
            <frame src="{{URL('main')}}" id="main-frame" name="main" frameborder="yes" scrolling="yes">
        </frameset>
    </frameset>

</frameset>

<frameset rows="0, 0" framespacing="0" border="0">
    <frame src="" id="hidd-frame" name="hidd-frame" frameborder="no" scrolling="no">
</frameset>
</html>
