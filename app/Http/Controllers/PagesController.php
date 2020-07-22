<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Progresscount;

class PagesController extends Controller
{
    //

    public function progress()
    {
        $progress=Progresscount::where('id',1)->get();
        $progress=$progress[0];
        $percentage=floor(($progress->presentCount/$progress->targetCount)*100);
        $id=$progress->id;
        $data=array(
            'percentage'=>$percentage,
            'id'=>$id
        );
        // return compact([$percentage,$id]);
         return view('progress')->with($data);
    }

    public function addmore(){
       
      return view('addmore');
    }

    public function tasks(){
       
        return view('tasklist');
      }
}
