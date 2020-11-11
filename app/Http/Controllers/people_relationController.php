<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\people_relation;

class people_relationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relation = people_relation::orderby('id','desc')->paginate();
        return response()->json($relation,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user1'=>'required',
            'special_day'=>'required',
            'user2' => 'required',
        ]);
        
        $relation = new people_relation();
        $relation->user1 = $request->user1;
        $relation->special_day =$request->special_day;
        $relation->user2 = $request->user2;
        $relation->name1 =$request->name1;
        $relation->name2=$request->name2;
        if($relation ->save()){
            return response() ->json($relation,200);
        }else{
            return response() ->json($relation,500);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function destroy(people_relation $relation)
    {
        if($relation ->delete()){
            
            return response()->json([
                'message' =>'delete relation success',
                'status_code'=>'200',
            ],200);
        }else{
            return response()->json([
                'message' =>'delete relation erorr , try again',
                'status_code'=>'500',
            ],500);
        }
    }
}
