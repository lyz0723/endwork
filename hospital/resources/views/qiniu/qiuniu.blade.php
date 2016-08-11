<html>
    <head></head>
    <body>
        <form method="post" action="{{URL('file')}}" enctype="multipart/form-data">
            <p>图片：<input type="file" name="file"/></p>
            <input type="hidden" name="_token"         value="<?php echo csrf_token() ?>"/>
            <input type="submit" value="提交"/>
        </form>
    </body>
</html>