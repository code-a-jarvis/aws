<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Progresscount;

class ProgressCountController extends Controller
{
    //
    public function increase(){
         $id=1;
         $pc=Progresscount::find($id);
        $ct=$pc->presentCount+1;
        $pc->presentCount=$ct;
        $pc->save();
        return redirect('/progress')->with('success',"count updated");

    }
}