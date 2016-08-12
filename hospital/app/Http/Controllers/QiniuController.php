<?php
namespace App\Http\Controllers;
use Request;
use Input , Response;
use Session;
use DB;
class QiniuController extends Controller{
    public function index(){
        return view('qiniu/qiuniu');
    }
    public function  file(){
        $file=Request::file('file');
        $allowed = ["png", "jpg", "gif","jpeg"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed)) {
            return ['error' => '您只能上传 png, jpg 或 gif格式的图片'];
        }
        $path = './public/Uploads/';
        $extension = $file->getClientOriginalExtension();
        $filename = str_random(10).'.'.$extension;
        //echo $filename;die;
        $file->move($path , $filename);

        $disk = \Storage::disk('qiniu');
        $contents=file_get_contents($path."/".$filename);
        $disk->put($filename,$contents);
    }
}
?>