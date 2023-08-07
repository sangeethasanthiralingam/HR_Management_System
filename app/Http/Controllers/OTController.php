<?php

namespace App\Http\Controllers;

use App\Models\OT;
use Illuminate\Http\Request;
use DB;
class OTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllot(Request $request)
    {
        
        try {
            $ot = DB::table('o_t_s as o')
        ->select('o.id','e.first_name as employee','e.basic_salary as basic_salary','o.ot_hour','o.hour_payment','o.total')
        ->leftJoin('employees as e', 'e.id', '=', 'o.employee');

           $search = $request->search;
           if (!is_null($search)){
               $ot = $ot
               ->where('o.id','LIKE','%'.$search.'%')
               ->orWhere('o.employee','LIKE','%'.$search.'%');
           }
           $ot = $ot->orderBy('o.id','desc')->get();

           return response()->json([
               "message" => "instructor Data",
               "data" => $ot,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getot($id)
    {
        try {
            $ot = DB::table('o_t_s as o')
        ->select('o.id','e.first_name as employee','e.basic_salary as basic_salary','o.ot_hour','o.hour_payment','o.total')
        ->leftJoin('employees as e', 'e.id', '=', 'o.employee')
        ->where('o.id', $id)
        ->first();
          
      

           return response()->json([
               "message" => "instructor Data",
               "data" => $ot,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveot(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
               'ot_hour'=>'required',
               'hour_payment'=>'required',
               'total'=>'required'


            ]);

            $ot = new OT();
            $ot->employee = $request->employee;
            $ot->hour_payment = $request->hour_payment;
            $ot->ot_hour = $request->ot_hour;
            $ot->total = $request->total;
           
            $ot->save();

            DB::commit();

            return response()->json([
                "msg" => "ot Data",
                "data" => $ot,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OT  $oT
     * @return \Illuminate\Http\Response
     */
    public function updateot(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
               'ot_hour'=>'required',
               'hour_payment'=>'required',
               'total'=>'required'


            ]);

            $ot = OT::find($id);
            $ot->employee = $request->employee;
            $ot->hour_payment = $request->hour_payment;
            $ot->ot_hour = $request->ot_hour;
            $ot->total = $request->total;
           
            $ot->save();

            DB::commit();

            return response()->json([
                "msg" => "ot Data",
                "data" => $ot,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OT  $oT
     * @return \Illuminate\Http\Response
     */
    public function destroyot($id)
    {
        try {
            $ot = OT::find($id);
            $ot->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    }

 

