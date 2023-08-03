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
                ->select('sad.id', 'e.first_name as employee', 'sad.type', 'sad.from_date', 'sad.to_date','sad.amount_per_month','sad.description')
                ->leftJoin('employees as e', 'e.id', '=', 'employee');

            $search = $request->search;

            if (!is_null($search)) {
                $salary_advances = $salary_advances
                    ->where('sad.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.employee', 'LIKE', '%' . $search . '%');
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
    public function getSalaryAdavanceInfo($id)
    {
        try {

            $salary_advances = DB::table('salary_advances as sad')
            ->select('sad.id', 'e.first_name as employee', 'sad.type', 'sad.from_date', 'sad.to_date','sad.amount_per_month', 'sad.description')
            ->leftJoin('employees as e', 'e.id', '=', 'employee')
                ->where('sad.id', $id)
                ->first();

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
    
    public function saveSalaryAdvance(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'amount_per_month' => 'required',
                'type' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'description' => 'required'
            ]);

            $salary_advances = new SalaryAdvance();
            $salary_advances->employee = $request->employee;
            $salary_advances->amount_per_month = $request->amount_per_month;
            $salary_advances->type = $request->type;
            $salary_advances->from_date = $request->from_date;
            $salary_advances->to_date = $request->to_date;
            $salary_advances->description = $request->description;
            $salary_advances->save();

            DB::commit();

            return response()->json([
                "msg" => "salary_advances Data",
                "data" => $salary_advances,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function updateSalaryAdvance(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'amount_per_month' => 'required',
                'type' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'description' => 'required'
            ]);

            $salary_advances = SalaryAdvance::find($id);
            $salary_advances->employee = $request->employee;
            $salary_advances->amount_per_month = $request->amount_per_month;
            $salary_advances->type = $request->type;
            $salary_advances->from_date = $request->from_date;
            $salary_advances->to_date = $request->to_date;
            $salary_advances->description = $request->description;
            $salary_advances->save();

            DB::commit();

            return response()->json([
                "msg" => "salary_advances Data",
                "data" => $salary_advances,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function destroySalaryAdvance($id)
    {
        try {
            $salary_advances = SalaryAdvance::find($id);
            $salary_advances->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
