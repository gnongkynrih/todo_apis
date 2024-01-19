<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Requests\CreateTaskRequest;

class TaskController extends Controller
{
    public function store(CreateTaskRequest $request){
        $task = new Task;
        $task->desc = $request->desc;
        $task->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Task created successfully'
        ],201);
    }

    public function update(Task $task,Request $request){
        try{
            
            $task->desc = $request->desc;
            $task->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Task updated successfully'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ],404);
        }
    }
    public function destroy($id){
        try{
            $task = Task::find($id);//will search for the primary key
            if($task==null){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Task not found'
                ],404);   
            }
            $task->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ],404);
        }
    }
    public function show($id){
        try{
            $task = Task::find($id);//will search for the primary key
            if($task==null){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Task not found'
                ],404);   
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Task found successfully',
                'data' => new TaskResource($task)
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ],404);
        }
    }
    public function index(){
        $tasks = Task::all();// select * from tasks
        if($tasks->count()==0){
            return response()->json([
                'status' => 'success',
                'message' => 'No records found'
            ],201);   
        }
        return response()->json([
            'status' =>'success',
            'message' => 'Tasks found successfully',
            'data' => TaskResource::collection($tasks)
        ],200);
    }

    public function updateStatus(Task $task,Request $request){
        $task->is_completed = $request->is_completed;
        $task->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully'
        ],200);
    }

    public function searchTask($search){
        //select * from tasks where desc like %search%
        $tasks = Task::where('desc','like','%'.$search.'%')->get();
        if($tasks->count()==0){
            return response()->json([
                'status' => 'success',
                'message' => 'No records found'
            ],201);   
        }
        return response()->json([
            'status' =>'success',
            'message' => 'Tasks found successfully',
            'data' => $tasks
        ],200);
    }
}
