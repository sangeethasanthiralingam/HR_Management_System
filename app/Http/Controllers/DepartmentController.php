<?php

namespace App\Http\Controllers;

use App\Models\department;
use Illuminate\Http\Request;
use DB;
class DepartmentController extends Controller
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
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(department $department)
    {
        //
    }
        
    public function getAllDepartments(Request $request)
    {
        //  try {
        $departments = DB::table('departments as d')
            ->select('d.id', 'd.name', 'd.description');

        $search = $request->search;

        if (!is_null($search)) {
            $departments = $departments
                ->where('d.name', 'LIKE', '%' . $search . '%')
                ->orWhere('d.description', 'LIKE', '%' . $search . '%');
        }

        $departments = $departments->orderBy('id', 'asc')
            ->get();

        return response()->json([
            "message" => "Departments Data",
            "data" => $departments,
        ], 200);
        //  } catch (\Throwable $e) {
        //      return response()->json([
        //          "message" => "Oops somthing went wrong please try again",
        //          "error" => $e->getMessage(),
        //      ], 500);
        //  }
    }

    public function getDepartmentInfo($id)
    {

        //  try {
        $departments = DB::table('departments as d')
            ->select('d.id', 'd.name', 'd.description')
            ->where('d.id', $id)
            ->first();

        return response()->json([
            "message" => "Departments Data",
            "data" => $departments,
        ], 200);
        //  } catch (\Throwable $e) {
//      return response()->json([
//          "message" => "Oops somthing went wrong please try again",
//          "error" => $e->getMessage(),
//      ], 500);
//  }


    }

    public function saveDepartment(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $department = new Department();
            $department->name = $request->name;
            $department->description = $request->description;
            $department->created_at = new \DateTime();
            $department->save();

            DB::commit();

            return response()->json([
                "message" => "Qualification Data",
                "data" => $department,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function updateDepartment(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $department = Department::find($id);
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            DB::commit();

            return response()->json([
                "msg" => "department Data",
                "data" => $department,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }


    }

    public function destroyDepartment($id)
    {
        try {
            $department = Department::find($id);
            $department->delete();

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

}
