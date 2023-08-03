<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use DB;
class AnnouncementController extends Controller
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
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
          /**************************API functions**********************************/

          public function getAllAnnouncement(Request $request)
          {//return "s";
              try {
                  //$announcements = Announcement::all();
                  $announcements = DB::table('announcements as a')
                 ->select('a.id','a.date','a.attachment','a.description','a.title');

                 $search = $request->search;
                 if (!is_null($search)){
                     $announcements = $announcements
                     ->where('a.id','LIKE','%'.$search.'%')
                     ->orWhere('a.date','LIKE','%'.$search.'%')
                     ->orWhere('a.attachment','LIKE','%'.$search.'%')
                     ->orWhere('a.description','LIKE','%'.$search.'%')
                     ->orWhere('a.title','LIKE','%'.$search.'%');
                 }
                 $announcements = $announcements->orderBy('a.id','desc')->get();
 
                 return response()->json([
                     "message" => "announcement Data",
                     "data" => $announcements,
                 ],200);
             }catch(\Throwable $e){
                 return response()->json([
                     "message"=>"oops something went wrong",
                     "error"=> $e->getMessage(),
                 ],500);
             }
         }
          public function getAnnouncement($id)
          {
            try{
 
                $announcements = DB::table('announcements as a')
                ->select('a.id','a.date','a.attachment','a.description','a.title')
                ->where('a.id',$id)
                ->first();
    
                return response()->json([
                    "message" => "Position Data",
                    "data" => $announcements,
                ],200);
            }catch(\Throwable $e){
                return response()->json([
                    "message"=>"oops something went wrong",
                    "error"=> $e->getMessage(),
                ],500);
            }
          }
      
          public function saveAnnouncement(Request $request)
          {
            DB::beginTransaction();
            try{
            $request->validate([
                'date'=>'required',
                'attachment'=>'required',
                'description'=>'required',
                'title'=>'required',
            ]);
    
            $announcements = new Announcement();
            $announcements->date = $request->date;
            $announcements->attachment = $request->attachment;
            $announcements->description = $request->description;
            $announcements->title = $request->title;
            $announcements->save();
    
            DB::commit();
    
            return response()->json([
                "msg" => "announcement Data",
                "data"=> $announcements,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
          }
      
          public function updateAnnouncement(Request $request, $id)
          {
            DB::beginTransaction();
            try{
            $request->validate([
                'date'=>'required',
                'attachment'=>'required',
                'description'=>'required',
                'title'=>'required',
            ]);
            $announcements = Announcement::find($id);
           
            $announcements->date = $request->date;
            $announcements->attachment = $request->attachment;
            $announcements->description = $request->description;
            $announcements->title = $request->title;
            $announcements->save();
         
          DB::commit();
    
          return response()->json([
            "msg" => "announcements Data",
            "data"=> $announcements,
        ],201);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
          }
      
          public function destroyAnnouncement($id)
          {
            try {
                $announcements= Announcement::find($id);
                $announcements->delete();
                
            } catch (\Throwable $e) {
                return response()->json([
                    "message" => "Ooops Something went wrong please try again",
                    "error" => $e->getMessage(),
                ], 500);
            }
        }
}
