<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class TaskController extends Controller
{

   public function show(){
       $tasks=Task::orderBy('taskId','desc')->get();

       return view('task.show')->with('tasks',$tasks);
   }

    public function store(Request $r){
        $task=new Task;
        $task->name= $r->task;
        $task->userId=Auth::user()->userId;
        $task->status=1;
        $task->save();

        $test=$r->task.'-by <i>'.Auth::user()->firstName.'</i>';
        return $test;
    }

    public function change(Request $r){
        $task=Task::findOrFail($r->id);
        if($task->status == 1){
            $task->status=0;
        }
        else{
            $task->status=1;
        }
        $task->save();
        return $r;
    }
}
