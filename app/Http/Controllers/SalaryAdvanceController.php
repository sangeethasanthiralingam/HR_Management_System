<?php

namespace App\Http\Controllers;

use App\Models\SalaryAdvance;
use Illuminate\Http\Request;
use DB;
class SalaryAdvanceController extends Controller
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
     * @param  \App\Models\SalaryAdvance  $salaryAdvance
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryAdvance $salaryAdvance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryAdvance  $salaryAdvance
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryAdvance $salaryAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryAdvance  $salaryAdvance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryAdvance $salaryAdvance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryAdvance  $salaryAdvance
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryAdvance $salaryAdvance)
    {
        //
    }

    public function getAllSalaryAdvances(Request $request)
    {

        try {
            $salary_advances = DB::table('salary_advances as sad')
                ->select('sad.id', 'sad.bio_code', 'sad.type', 'sad.from_date', 'sad.to_date', 'sad.description')
                ->leftJoin('employees', 'sad.bio_code', '=', 'employees.bio_code');

            $search = $request->search;

            if (!is_null($search)) {
                $salary_advances = $salary_advances
                    ->where('sad.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.bio_code', 'LIKE', '%' . $search . '%');
            }
            $salary_advances = $salary_advances->orderBy('sad.id')->get();

            return response()->json([
                "message" => "salary_advances Data",
                "data" => $salary_advances,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    
    
}
