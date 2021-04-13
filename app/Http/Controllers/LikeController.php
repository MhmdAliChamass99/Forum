<?php

namespace App\Http\Controllers;
use Auth;
use Arr;
use DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\group;
use Illuminate\Http\Request;

class LikeController extends Controller
{
   
    public function AddLike(Request $request)
    {
        // $Like=new Like();

        // $Like->user_id=Auth::id();
        // $Like->post_id=$id;
        // $Like->save();
        //$posts=Post::find($id);
        //::user()->Like($posts);
        // $group=group::find($request->group_id);

        //$posts=Post::where('group_id',$request->group_id)->orderBy('created_at','desc')->get();

        // return view('Groups.GroupDetails',compact('group','posts'));
        //return back();
          $pid= $request->post_id;
          $Like=new Like();

            $Like->user_id=Auth::id();
            $Like->post_id=$pid;
            $Like->save();
    
         
          return response()->json(['success'=>'Success']);
        
    }
    public function RemoveLike(Request $request)
    {
       
          $pid= $request->post_id;
         $Like=new Like();

        //     $Like->user_id=Auth::id();
        //     $Like->post_id=$pid;
            $Like->where('user_id',Auth::id())->where('post_id',$pid)->delete();
    
         
          return response()->json(['success'=>'Success']);
        
    }
    public function LikeCounter($id)
    {
       
     
         $Like=Like::where('post_id',$id)->count();
        
        //     $Like->user_id=Auth::id();
        //     $Like->post_id=$pid;
          //  $Like->where('user_id',Auth::id())->where('post_id',$pid)->delete();
    
            return response()->json(array('success' => true, 'getstamps' => $Like));
        //  return response()->json(['success'=>'Success']);
        
    }
   
}
