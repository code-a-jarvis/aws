<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;

class TasksController extends Controller
{
    //
    public function index() {
        $todotasks=Task::where('category','todo')->OrderBy('position','asc')->get();
        $doing=Task::where('category','doing')->OrderBy('position','asc')->get();
        $donetasks=Task::where('category','done')->OrderBy('position','asc')->get();
        $data=array(
            'todotasks'=>$todotasks,
            'doing'=>$doing,
            'donetasks'=>$donetasks

        );
        return view('tasklist')->with($data);
        
    }

    public function add(Request $request){
        
        $pos=Task::where('category','todo')->get()->count();
        $task=new Task;
        $task->name=$request->input('task');
        $task->position=$pos+1;
        $task->save();
       return redirect('/tasks');
    }

    public function save(Request $request){
        // $input=$request->all();
        // \Log::info($request->input('todo'));
        //  $todo=$request->input('todo');
        $todo=$request->input('todo');
        parse_str($todo,$id);
         $ct=1;
        
        $id=$id['id'];
        \Log::info(count($id));
         foreach($id as $taskid){
            \Log::info($taskid);
             $task=Task::find($taskid);
             $task->category='todo';
             $task->position=$ct;
             $ct++;
             \Log::info($task);
             $task->save();   
         }
         $todo=$request->input('doing');
         parse_str($todo,$id);
         $ct=1;
         $id=$id['id'];
         foreach($id as $taskid){
             $task=Task::find($taskid);
             $task->category='doing';
             $task->position=$ct;
             $ct++;
             $task->save();
         }

         $todo=$request->input('done');
         parse_str($todo,$id);
         $ct=1;
         $id=$id['id'];
         foreach($id as $taskid){
             $task=Task::find($taskid);
             $task->category='done';
             $task->position=$ct;
             $ct++;
             $task->save();
         }
        return response()->json([
            'success'=>'Data updated'
        ]);

    }
}
