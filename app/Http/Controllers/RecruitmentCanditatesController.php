<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentCanditates;
use Illuminate\Http\Request;
use DB;
class RecruitmentCanditatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return"f";
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
     * @param  \App\Models\RecruitmentCanditates  $recruitmentCanditates
     * @return \Illuminate\Http\Response
     */
    public function show(RecruitmentCanditates $recruitmentCanditates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecruitmentCanditates  $recruitmentCanditates
     * @return \Illuminate\Http\Response
     */
    public function edit(RecruitmentCanditates $recruitmentCanditates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecruitmentCanditates  $recruitmentCanditates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecruitmentCanditates $recruitmentCanditates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecruitmentCanditates  $recruitmentCanditates
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecruitmentCanditates $recruitmentCanditates)
    {
        //
    }
/******************************************************************************************************************************************************api */
    public function getAllRecruitmentCandidates(Request $request)
    {  
        try {
            $recruit_candi = DB::table('recruitment_canditates as r')
           ->select('r.id','r.first_name','r.last_name','r.dob','r.gender','r.phone_no','r.e_mail','r.resume','r.application_date','p.id as position_applied_for','interview_status')
           ->leftJoin('positions as p', 'p.id', '=', 'r.position_applied_for');

           $search = $request->search;

           if (!is_null($search)){
               $recruit_candi = $recruit_candi
               ->where('r.id','LIKE','%'.$search.'%')
               ->orWhere('r.first_name','LIKE','%'.$search.'%')
               ->orWhere('r.last_name','LIKE','%'.$search.'%')
               ->orWhere('r.dob','LIKE','%'.$search.'%')
               ->orWhere('r.phone_no','LIKE','%'.$search.'%')
               ->orWhere('r.e_mail','LIKE','%'.$search.'%')
               ->orWhere('r.resume','LIKE','%'.$search.'%')
               ->orWhere('r.position_applied_for','LIKE','%'.$search.'%')
               ->orWhere('r.interview_status','LIKE','%'.$search.'%');
               


           }
          

           $recruit_candi = $recruit_candi->orderBy('r.id','desc')->get();

           return response()->json([
               "message" => "Recruitment candidates Data",
               "data" => $recruit_candi,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }

    
    public function getRecruitmentCandidateInfo($id)
    {return "r";
        try{

            $recruit_candi = DB::table('recruitment_canditates as r')
            ->select('r.id','r.first_name','r.last_name','r.dob','r.gender','r.phone_no','r.e_mail','r.resume','r.application_date','p.id as position_applied_for','interview_status')
            ->leftJoin('positions as p', 'p.id', '=', 'r.position_applied_for');

      
           $recruit_candi = $recruit_candi->orderBy('r.id','desc')
            ->where('r.id',$id)
            ->first();

            return response()->json([
                "message" => "Recruitment candidates Data",
                "data" => $recruit_candi,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    
    public function saveRecruitmentCandidates(Request $request)
    {
        DB::beginTransaction();

        try{
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
            ]);
    
            $recruit_candi = new RecruitmentCanditates();
            $recruit_candi->first_name = $request->first_name;
            $recruit_candi->last_name = $request->last_name;
            $recruit_candi->dob = $request->dob;
            $recruit_candi->gender = $request->gender;
            $recruit_candi->phone_no = $request->phone_no;
            $recruit_candi->e_mail = $request->e_mail;
            $recruit_candi->resume = $request->resume;
            $recruit_candi->application_date = $request->application_date;
            $recruit_candi->position_applied_for = $request->position_applied_for;
            $recruit_candi->interview_status = $request->interview_status;
            $recruit_candi->save();
    
            DB::commit();
    
            return response()->json([
                "msg" => "Recruitment candidates Data",
                "data"=> $recruit_candi,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

   
    public function updateRecruitmentCandidates(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
            ]);

            $recruit_candi = RecruitmentCanditates::find($id);
            $recruit_candi->first_name = $request->first_name;
            $recruit_candi->last_name = $request->last_name;
            $recruit_candi->dob = $request->dob;
            $recruit_candi->gender = $request->gender;
            $recruit_candi->phone_no = $request->phone_no;
            $recruit_candi->e_mail = $request->e_mail;
            $recruit_candi->resume = $request->resume;
            $recruit_candi->application_date = $request->application_date;
            $recruit_candi->position_applied_for = $request->position_applied_for;
            $recruit_candi->interview_status = $request->interview_status;
            $recruit_candi->save();
        
            DB::commit();

            return response()->json([
                "msg" => "Recruitment candidates Data",
                "data"=> $recruit_candi,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
        }

    public function destroyRecruitmentCandidate($id)
    {
        try{
                $recruit_candi = RecruitmentCanditates::find($id);
                $recruit_candi ->delete();

            }
            catch(\Throwable $e){
            return response()->json([
                "message"=>"Ooops Something went wrong please try again",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
}
