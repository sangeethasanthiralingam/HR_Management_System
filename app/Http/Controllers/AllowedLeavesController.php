<?php

namespace App\Http\Controllers;

use App\Models\AllowedLeaves;
use Illuminate\Http\Request;
use DB;
class AllowedLeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAllowedLeaves(Request $request)
    {
        //jjj
        try {
            $allowedleaves = DB::table('allowed_leaves as l')
           ->select('l.id','p.id as position','t.id as type','l.term','l.count')
           ->leftJoin('positions as p', 'p.id', '=', 'l.position')
           ->leftJoin('leave_types as t','t.id','=','l.type');

           $search = $request->search;
           if (!is_null($search)){
               $allowedleaves = $allowedleaves
               ->where('l.id','LIKE','%'.$search.'%')
               ->orWhere('l.position','LIKE','%'.$search.'%')
               ->orWhere('l.type','LIKE','%'.$search.'%')
               ->orWhere('l.term','LIKE','%'.$search.'%');
           }
           $allowedleaves = $allowedleaves->orderBy('l.id','desc')->get();

           return response()->json([
               "message" => "allowedleaves Data",
               "data" => $allowedleaves,
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
    public function getAllowedLeavesinfo($id)
    {
        try{

            $allowedleaves = DB::table('allowed_leaves as l')
            ->select('l.id','p.id as position','t.id as type','l.term','l.count')
            ->leftJoin('positions as p', 'p.id', '=', 'l.position')
            ->leftJoin('leave_types as t','t.id','=','l.type');
            $allowedleaves = $allowedleaves->orderBy('l.id','desc')
            ->where('l.id',$id)
            ->first();

            return response()->json([
                "message" => "allowedleaves Data",
                "data" => $allowedleaves,
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
    public function saveAllowedLeaves(Request $request)
    {
        try{
            $request->validate([
                'position'=>'required',
                'type'=>'required',
                'term'=>'required',
                'count'=>'required',
            ]);

            $allowedleaves = new AllowedLeaves();
            $allowedleaves->position = $request->position;
            $allowedleaves->type = $request->type;
            $allowedleaves->term = $request->term;
            $allowedleaves->count = $request->count;
            $allowedleaves->save();

            DB::commit();

            return response()->json([
                "msg" => "allowedleaves Data",
                "data"=> $allowedleaves,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    public function updateAllowedLeaves(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'position'=>'required',
                'type'=>'required',
                'term'=>'required',
                'count'=>'required',
            ]);
            $allowedleaves = AllowedLeaves::find($id);

            $allowedleaves = new AllowedLeaves();
            $allowedleaves->position = $request->position;
            $allowedleaves->type = $request->type;
            $allowedleaves->term = $request->term;
            $allowedleaves->count = $request->count;
            $allowedleaves->save();
        
            DB::commit();

            return response()->json([
            "msg" => "allowedleaves Data",
            "data"=> $allowedleaves,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    public function destroyAllowedLeaves($id)
    {
        try{
                $allowedleaves = AllowedLeaves::find($id);
                $allowedleaves ->delete();

            }
            catch(\Throwable $e){
            return response()->json([
                "message"=>"Ooops Something went wrong please try again",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AllowedLeaves  $allowedLeaves
     * @return \Illuminate\Http\Response
     */
    public function show(AllowedLeaves $allowedLeaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AllowedLeaves  $allowedLeaves
     * @return \Illuminate\Http\Response
     */
    public function edit(AllowedLeaves $allowedLeaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AllowedLeaves  $allowedLeaves
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllowedLeaves $allowedLeaves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AllowedLeaves  $allowedLeaves
     * @return \Illuminate\Http\Response
     */
    public function destroy(AllowedLeaves $allowedLeaves)
    {
        //
    }
}
