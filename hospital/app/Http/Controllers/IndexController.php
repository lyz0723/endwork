<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //前台首页
        return view('home/index');
    }

    public function find_doctor(){
        // 找医生
        return view('home/find_doctor');
    }

    public function request_appointment(){
        return view('home/request_appointment');
    }

    public function contact_us(){
        return view('home/contact_us');
    }

    public function Care_Services(){
        return view('home/Care_Services');
    }

    public function our_doctors(){
        return view('home/our_doctors');
    }

    public function patients(){
        return view('home/patients');
    }

    public function visitiors(){
        return view('home/visitiors');
    }

    public function health_information(){
        return view('home/health_information');
    }

    public function about_us(){
        return view('home/about_us');
    }


}
