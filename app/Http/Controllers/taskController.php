<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\task;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = task::orderBy('created_at','desc')-> paginate();
        return response() ->json($tasks,200);
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request ->validate([
            'name'=> 'required|min:3',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);
        $task = new task();
        $task ->name = $request ->name;
        $path = $request->file('image')->store('task_image');

        $task->image = $path;
        if($task ->save()){
            return response() ->json($task,200);
        }else{
            return response() ->json($task,500);
        }

        

        dd($request->all());
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        if($task ->delete()){
            Storage::delete($task->image);
            return response()->json([
                'message' =>'delete task success',
                'status_code'=>'200',
            ],200);
        }else{
            return response()->json([
                'message' =>'delete task erorr , try again',
                'status_code'=>'500',
            ],500);
        }
    }
}
