<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use DB;
class LeaveRequestController extends Controller
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
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        //
    }
    
    public function getAllLeave_requests(Request $request)
    {
        //  try {
        $leave_requests = DB::table('leave_requests as l')
            ->select('l.id', 'e.bio_code as employees', 'e.name as employee', 'p.name as position', 'a.type as leave_type', 'l.request_on', 'l.dates', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
            ->leftJoin('employees as e', 'e.id', '=', 'l.bio_code')
            ->leftJoin('employees as e', 'e.id', '=', 'l.employee')
            ->leftJoin('positions as p', 'p.id', '=', 'l.position')
            ->leftJoin('allowed_leaves as a', 'a.id', '=', 'l.leave_type')
            ->leftJoin('users as u', 'u.id', '=', 'l.approved_by');

        $search = $request->search;
       
        if (!is_null($search)) {
            $leave_requests = $leave_requests
                ->where('l.bio_code', 'LIKE', '%' . $search . '%')
                ->orWhere('l.employee', 'LIKE', '%' . $search . '%')
                ->orWhere('l.position', 'LIKE', '%' . $search . '%')
                ->orWhere('l.leave_type', 'LIKE', '%' . $search . '%')
                ->orWhere('l.request_on', 'LIKE', '%' . $search . '%')
                ->orWhere('l.reason', 'LIKE', '%' . $search . '%');
        }

        $leave_requests = $leave_requests->orderBy('id', 'asc')->get();
            return "b";
        return response()->json([
            "message" => "leave_requests Data",
            "data" => $leave_requests,
        ], 200);
        //  } catch (\Throwable $e) {
        //      return response()->json([
        //          "message" => "Oops somthing went wrong please try again",
        //          "error" => $e->getMessage(),
        //      ], 500);
        //  }

    }

    public function getAllLeave_requestInfo($id)
    {
        //  try {
        $leave_requests = DB::table('leave_requests as l')
        ->select('l.id', 'e.bio_code as employee', 'e.name as employee', 'p.name as position', 'a.type as leave_type', 'l.request_on', 'l.dates', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
        ->leftJoin('employee as e', 'e.id', '=', 'l.bio_code')
        ->leftJoin('employee as e', 'e.id', '=', 'l.employee')
        ->leftJoin('positions as p', 'p.id', '=', 'l.position')
        ->leftJoin('allowed_leaves as a', 'a.id', '=', 'l.leave_type')
        ->leftJoin('users as u', 'u.id', '=', 'l.approved_by')
        ->where('l.id', $id)
        ->first();

        return response()->json([
            "message" => "leave_requests Data",
            "data" => $leave_requests,
        ], 200);
        //  } catch (\Throwable $e) {
        //      return response()->json([
        //          "message" => "Oops somthing went wrong please try again",
        //          "error" => $e->getMessage(),
        //      ], 500);
        //  }

    }

    public function saveLeave_requestInfo(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'bio_code' => 'required',
                'employee' => 'required',
                'position' => 'required',
                'leave_type' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leave_request = new LeaveRequest();
            $leave_request->bio_code = $request->bio_code;
            $leave_request->employee = $request->employee;
            $leave_request->position = $request->position;
            $leave_request->leave_type = $request->leave_type;
            $leave_request->request_on = $request->request_on;
            $leave_request->dates = $request->dates;
            $leave_request->days = $request->days;
            $leave_request->reason = $request->reason;
            $leave_request->status = $request->status;
            $leave_request->approved_by = $request->approved_by;
            $leave_request->created_at = new \DateTime();
            $leave_request->save();

            DB::commit();

            return response()->json([
                "message" => "Leave_request Data",
                "data" => $leave_request,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function updateLeave_requestInfo(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'bio_code' => 'required',
                'employee' => 'required',
                'position' => 'required',
                'leave_type' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leave_request = LeaveRequest::find($id);
            $leave_request->bio_code = $request->bio_code;
            $leave_request->employee = $request->employee;
            $leave_request->position = $request->position;
            $leave_request->leave_type = $request->leave_type;
            $leave_request->request_on = $request->request_on;
            $leave_request->dates = $request->dates;
            $leave_request->days = $request->days;
            $leave_request->reason = $request->reason;
            $leave_request->status = $request->status;
            $leave_request->approved_by = $request->approved_by;
            $leave_request->created_at = new \DateTime();
            $leave_request->save();
            DB::commit();

            return response()->json([
                "msg" => "leave_request Data",
                "data" => $leave_request,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function DistroyLeave_request($id)
    {
        try {
            $leave_request = LeaveRequest::find($id);
            $leave_request->delete();

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


}
