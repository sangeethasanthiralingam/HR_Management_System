<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use DB;

class CompanyController extends Controller
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
    /*****************************API Functions******************************************************************/
    public function getAllCompanies(Request $request)
{
    try{
        $companies = DB::table ('companies as c') 
        ->select('c.id','c.name','c.description') ;

        $search = $request->search;
       
        if(!is_null($search)) {
            $companies = $companies->where('c.name','LIKE','%'.$search.'%');
        }
        $companies=$companies->orderBy('id','desc')->get();
       
        return response()->json([
            "message"=>"companies Data",
            "data"=> $companies,
        ],200);
    }catch(\throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}
    


public function getCompanyInfo($id)
{
    try{

        $company = DB::table ('companies as c') 
        ->select('c.id','c.name','c.description') 
        ->where('c.id',$id)
        ->first();

        return response()->json([
            "message"=>"company Data",
            "data"=> $company,
        ],200);

    }catch(\throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
}
public function saveCompany(Request $request)
{
    DB::beginTransaction();
    try{

            // return $request;
            $request ->validate([
                'name'=> 'required',
                'description'=> 'required',
            ]);

            $company = new Company();
            $company->name = $request->name;
            $company->description = $request->description;
            $company->save();
            // 1/0;
        DB::commit();

        return response()->json([
            "message"=>"company Data",
            "data"=> $company,
        ],201);
       
       
    }catch(\throwable $e){
        DB::rollback();
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }

}

public function updateCompany(Request $request, $id)
{
    try {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                "message" => "Company not found.",
            ], 404);
        }

        $company->name = $request->name;
        $company->description = $request->description;
        $company->save();

        return response()->json([
            "message" => "Company updated successfully.",
            "data" => $company,
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            "message" => "Oops! Something went wrong. Please try again.",
            "error" => $e->getMessage(),
        ], 500);
    }
}

public function destroyCompany($id)
     {
         try{
                 $company = Company::find($id);
                 $company ->delete();
 
             }
             catch(\Throwable $e){
             return response()->json([
                 "message"=>"Ooops Something went wrong please try again",
                 "error"=> $e->getMessage(),
             ],500);
         }
     }
   
}
