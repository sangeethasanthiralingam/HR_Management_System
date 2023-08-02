<?php

namespace App\Http\Controllers;

use App\Models\salary_types;
use Illuminate\Http\Request;
use DB;
class SalaryTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "jjj";
    
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
     * @param  \App\Models\salary_types  $salary_types
     * @return \Illuminate\Http\Response
     */
    public function show(salary_types $salary_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salary_types  $salary_types
     * @return \Illuminate\Http\Response
     */
    public function edit(salary_types $salary_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salary_types  $salary_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salary_types $salary_types)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salary_types  $salary_types
     * @return \Illuminate\Http\Response
     */
    public function destroy(salary_types $salary_types)
    {
        //
    }

    /*****************************API Functions******************************************************************/
public function getAllSalaryTypes(Request $request)
{
    try{
        $salaryTypes = DB::table ('salary_types as s') 
        ->select('s.id','s.title','s.category','s.description','s.created_at','s.updated_at');
        
        $search = $request->search;
       
        if(!is_null($search)) {
            $salaryTypes = $salaryTypes->where('s.title','LIKE','%'.$search.'%')
                                ->orWhere('s.description','LIKE','%'.$search.'%');
        }
        $salaryTypes=$salaryTypes->orderBy('id','desc')->get();
       
        return response()->json([
            "message"=>"salaryTypes Data",
            "data"=> $salaryTypes,
        ],200);
    }catch(\throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}
    
public function getSalaryTypeInfo($id)
{
    try{

        $salarytype = salaryType::find($id);
        // $salarytype = DB::table ('salary_types as s') 
        // ->select('s.id','s.title','s.category','s.description','s.created_at','s.updated_at') 
        // ->orderBy('id','desc')
        // ->first();

        return response()->json([
            "message"=>"salary Type Data",
            "data"=> $salarytype,
        ],200);

    }catch(\throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}
public function saveSalaryType(Request $request)
{
    DB::beginTransaction();
    try{

            // return $request;
            $request ->validate([
                'title'=> 'required',
                'category'=> 'required',
                'description'=> 'required'
            ]);

            $salaryType = new salaryType();
            $salaryType->title = $request->title;
            $salaryType->category = $request->category;
            $salaryType->description = $request->description;
            $salaryType->save();

            DB::commit();

        return response()->json([
            "message"=>"Salary Type Data",
            "data"=> $salaryType,
        ],201);
       
       
    }catch(\throwable $e){
        DB::rollback();
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function updateSalaryType(Request $request, $id)
{
    DB::beginTransaction();
    try{
            $request ->validate([
                'title'=> 'required',
                'category'=> 'required',
                'description'=> 'required'
            ]);
            
            $salaryType = salaryType::find($id);
            $salaryType->title = $request->title;
            $salaryType->category = $request->category;
            $salaryType->description = $request->description;
            $salaryType->save();
            DB::commit();

        }
        catch(\Throwable $e){
        DB::rollback();
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}

public function destroySalaryType($id)
{
    try{
            $salarytype = salaryType::find($id);
            $salarytype ->delete();

        }
        catch(\Throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}
}
