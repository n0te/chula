<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index(){
    	return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    }

    public function getJson(){
        return (String)Task::find(1);
    }

    /*public function addJson($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',]);
        if ($validator->fails()) {
            throw new Exception("Error Processing Request", 1);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return $task;
    }*/
}
