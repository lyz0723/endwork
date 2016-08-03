<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('person/index');
    }

    public function main(){
        return view('person/main');
    }

    public function menu(){
        return view('person/menu');
    }

    public function top(){
        return view('person/top');
    }


}
