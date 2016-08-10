<?php
namespace App\Http\Controllers;
use jpush;
use Request;
use Input , Response;
use Session;
use DB;
class JpushController extends Controller{
    public function showIndex(){
        $app_key="03f06f733fd8be4356f0866f";
        $master_secret="7d869fda186d0057e720875a";
        $client = new JPush($app_key, $master_secret);
        $result = $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert('Hi, JPush')
            ->send();

        echo 'Result=' . json_encode($result);
    }
}

    ?>
