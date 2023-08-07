<?php

namespace App\Http\Controllers;

use App\Models\Employee_benefits;
use Illuminate\Http\Request;
use DB;
class EmployeeBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $eb = DB::table('employee_benefits as eb')
        ->select('eb.id','e.first_name as employee','eb.benefit_type','eb.coverage_details','eb.premiums','eb.beneficiary_information')
        ->leftJoin('employees as e', 'e.id', '=', 'eb.employee');

           $search = $request->search;
           if (!is_null($search)){
               $eb = $eb
               ->where('eb.id','LIKE','%'.$search.'%')
               ->orWhere('eb.employee','LIKE','%'.$search.'%')
               ->orWhere('eb.benefit_type','LIKE','%'.$search.'%')
               ->orWhere('eb.coverage_details','LIKE','%'.$search.'%')
               ->orWhere('eb.premiums','LIKE','%'.$search.'%')
               ->orWhere('eb.beneficiary_information','LIKE','%'.$search.'%');

           }
           $eb = $eb->orderBy('eb.id','desc')->get();

           return response()->json([
               "message" => "Employee benefits Data",
               "data" => $eb,
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
    public function edit($id)
    {
        try {

            $eb = DB::table('employee_benefits as eb')
            ->select('eb.id','e.first_name as employee','eb.benefit_type','eb.coverage_details','eb.premiums','eb.beneficiary_information')
            ->leftJoin('employees as e', 'e.id', '=', 'eb.employee')
                ->where('eb.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee benefits Data",
                "data" => $eb,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'benefit_type' => 'required',
                'coverage_details' => 'required',
                'premiums' => 'required',
                'beneficiary_information' => 'required'
            ]);

            $EB = new Employee_benefits();
            $EB->employee = $request->employee;
            $EB->benefit_type = $request->benefit_type;
            $EB->coverage_details = $request->coverage_details;
            $EB->premiums = $request->premiums;
           
            $EB->beneficiary_information = $request->beneficiary_information;
            $EB->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee benefits Data",
                "data" => $EB,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee_benefits  $employee_benefits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request;
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'benefit_type' => 'required',
                'coverage_details' => 'required',
                'premiums' => 'required',
                'beneficiary_information' => 'required'
            ]);

            $EB =Employee_benefits ::find($id);
            $EB->employee = $request->employee;
            $EB->benefit_type = $request->benefit_type;
            $EB->coverage_details = $request->coverage_details;
            $EB->premiums = $request->premiums;
            $EB->to_date = $request->to_date;
            $EB->beneficiary_information = $request->beneficiary_information;
            $EB->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee benefits Data",
                "data" => $EB,
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee_benefits  $employee_benefits
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try {
            $EB = Employee_benefits::find($id);
            $EB->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
