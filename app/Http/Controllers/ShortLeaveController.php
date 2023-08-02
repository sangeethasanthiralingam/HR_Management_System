<?php

namespace App\Http\Controllers;

use App\Models\ShortLeave;
use Illuminate\Http\Request;
use DB;
class ShortLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortLeave  $shortLeave
     * @return \Illuminate\Http\Response
     */
    public function show(ShortLeave $shortLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShortLeave  $shortLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortLeave $shortLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShortLeave  $shortLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortLeave $shortLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortLeave  $shortLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortLeave $shortLeave)
    {
        //
    }
     /**************************API functions**********************************/
     public function getAllShortLeave(Request $request)
     {
     
         try{
             $shortLeaves = DB::table('short_leaves as s')
             ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
             ->leftJoin('employees as e', 'e.id', '=', 's.employee');
             
             $search = $request->search;
 
             if (!is_null($search)){
                 $shortLeaves = $shortLeaves
                 ->where('e.id','LIKE','%'.$search.'%')
                 ->where('employee','LIKE','%'.$search.'%')
                 ->orWhere('s.id','LIKE','%'.$search.'%')
                 ->orWhere('s.date','LIKE','%'.$search.'%');
             }
             $shortLeaves = $shortLeaves->orderBy('s.id','desc')->get();
 
             return response()->json([
                 "message" => "Short Leaves Data",
                 "data" => $shortLeaves,
             ],200);
         }catch(\Throwable $e){
             return response()->json([
                 "message"=>"oops something went wrong",
                 "error"=> $e->getMessage(),
             ],500);
         }
     }
 
     public function getShortLeaveInfo($id)
     {
         try{
 
             $shortLeaves = DB::table('short_leaves as s')
             ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
             ->leftJoin('employees as e', 'e.id', '=', 's.employee')
             ->where('s.id',$id)
             ->first();
 
             return response()->json([
                 "message" => "shortLeave Data",
                 "data" => $shortLeaves,
             ],200);
         }catch(\Throwable $e){
             return response()->json([
                 "message"=>"oops something went wrong",
                 "error"=> $e->getMessage(),
             ],500);
         }
     }
 
     public function saveshortLeave(Request $request)
     {
         DB::beginTransaction();
         try{
             $request->validate([
                 'employee'=>'required',
                 'date'=>'required',
                 'time_from'=>'required',
                 'time_to'=>'required',
                 'note'=>'required'
             ]);
 
             $shortLeaves = new ShortLeave();
             $shortLeaves->employee = $request->employee;
             $shortLeaves->date = $request->date;
             $shortLeaves->time_from = $request->time_from;
             $shortLeaves->time_to = $request->time_to;
             $shortLeaves->note = $request->note;
             $shortLeaves->save();
 
             DB::commit();
 
             return response()->json([
                 "msg" => "shortLeaves Data",
                 "data"=> $shortLeaves,
             ],201);
         }catch(\Throwable $e) {
             DB::rollback();
             return response()->json([
                 "msg"=>"oops something went wrong",
                 "error"=> $e->getMessage(),
             ],500);
         }
     }
 
     public function updateshortLeave(Request $request, $id)
     {
         DB::beginTransaction();
         try{
             $request->validate([
                 'employee'=>'required',
                 'date'=>'required',
                 'time_from'=>'required',
                 'time_to'=>'required',
                 'note'=>'required'
             ]);
 
             $shortLeaves = ShortLeave::find($id);
             $shortLeaves->employee = $request->employee;
             $shortLeaves->date = $request->date;
             $shortLeaves->time_from = $request->time_from;
             $shortLeaves->time_to = $request->time_to;
             $shortLeaves->note = $request->note;
             $shortLeaves->save();  
         
             DB::commit();
 
             return response()->json([
             "msg" => "shortLeaves Data",
             "data"=> $shortLeaves,
             ],201);
         }catch(\Throwable $e) {
             DB::rollback();
             return response()->json([
                 "msg"=>"oops something went wrong",
                 "error"=> $e->getMessage(),
             ],500);
         }
     }
 
     public function destroyshortLeave($id)
     {
         try{
                 $shortLeaves = ShortLeave::find($id);
                 $shortLeaves ->delete();
 
             }
             catch(\Throwable $e){
             return response()->json([
                 "message"=>"Ooops Something went wrong please try again",
                 "error"=> $e->getMessage(),
             ],500);
         }
    } 
}
