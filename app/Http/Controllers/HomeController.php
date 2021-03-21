<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Birthday;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    
        $search="2020-".strval(date('m'))."-".strval(date('d'));
        $name=Birthday::where('bdate',$search)->get();
        $data=array(
            'name'=>$name
        );

        return view('home')->with($data);
    }
}
