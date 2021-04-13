<?php

namespace App\Http\Controllers;
use Auth;
use Arr;
use DB;
use App\Models\User;
use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentController extends Controller
{
    public function addComment(Request $request){
        $pid= $request->post_id;
        $cmt=new comment();

          $cmt->user_id=Auth::id();
          $cmt->post_id=$pid;
        $cmt->text=$request->text;
          $cmt->save();
  
       
        return response()->json(['success'=>'Success']);
    }
    public function getComments(Request $request)
    {
        $cmt=comment::where('post_id',$request->post_id)->orderBy('created_at', 'desc')->first();
        return response()->json(array('success' => true, 'getstamps' => $cmt));
    }

}
