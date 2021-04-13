<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\group;
use App\Models\GroupMember;
use App\Models\groupAdmin;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    
        $id=Auth::id();
        $Groups=array();
        //$gg=DB::table('GroupMembers')->where('user_id','=',$id)->get();
        if(DB::table('group_members')->where('user_id','=',$id)->get()!=null)
        {
        $groupsmember=DB::table('group_members')->where('user_id','=',$id)->where('requested',2)->get();
        foreach($groupsmember as $v){

            $Group=group::find($v->group_id);
            if( $Group)
            array_push($Groups,$Group);
        }
        
    }
        return view('home',compact('Groups'));
    }
    public function profile()
    {
        $id=Auth::id();
        $user=User::find($id);
        return view('user.details',compact('user'));
    }
    public function editUser()
    {
        $id=Auth::id();
        $user=User::find($id);
        return view('user.edit',compact('user'));
    }
}
