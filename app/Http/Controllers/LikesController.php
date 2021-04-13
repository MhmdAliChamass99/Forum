<?php

namespace App\Http\Controllers;
use App\Models\schedule;
use Illuminate\Http\Request;
use Log;
use App\Models\LikesModel;
use Auth;

class LikesController extends Controller
{
    //
    public function ShowPage(){
        $schedule = new schedule;
        $courses=$schedule->getCoursesForLikes();
        $likes=new LikesModel;
        $id=Auth::user()->id;
        $coursesLiked=$likes->getLikes($id);
        //$showeha=$schedule->getCounter();
        //return view('userLike',['courses'=>$courses],['shokhaye'=>$showeha],['coursesLiked'=>$coursesLiked]);
        return view('userLike')->with('courses', $courses)->with('coursesLiked',$coursesLiked);
    }

    public function AddToLikes(Request $request)
    {
        Log::info('fuhawifhaiuhfawiuafwhiuh');
        $coursename=$request->coursename;
        $teachername=$request->teachername;
        $userid=$request->userid;
        $likes=new LikesModel;
        $likes->addLike($userid,$teachername,$coursename);
        Log::info('khalasna');
        return response()->json(['success'=>'Success']);
          
    }

    public function RemoveLikes (Request $request)
    {
        Log::info('fetna Remove');
        $coursename=$request->coursename;
        $teachername=$request->teachername;
        $userid=$request->userid;
        $likes=new LikesModel;
        $likes->removeLike($userid,$teachername,$coursename);
    }
}
