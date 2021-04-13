<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group;
use App\Models\groupAdmin;
use App\Models\GroupMember;
use Auth;
use Arr;
use DB;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
        //AllGroups->index
        $groups = group::all();
        $user=Auth::id();

       $user_groups=GroupMember::where('user_id',Auth::id())->get()->pluck('requested','group_id');

        return view('Groups.index',compact('groups','user_groups'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Groups.create');
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

    
        $group=new group();
        $group->GroupName=$request->groupname;
        $group->description=$request->description;
        $group->state=$request->state;
        $group->save();

        $admin=new groupAdmin();
        $admin->user_id=Auth::id();
        $admin->group_id=$group->id;
        $admin->save();

        $member=new GroupMember();
        $member->user_id=Auth::id();
        $member->group_id=$group->id;
        $member->requested=2;
        $member->save();
        
 

        return view('Groups.create',compact('group'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $group=group::find($id);

        $posts=Post::where('group_id',$id)->orderBy('created_at','desc')->get();

        return view('Groups.GroupDetails',compact('group','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $group=Group::find($id);
        
        return view('Groups.edit',compact('group'));
     

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group=Group::find($id);
        $group->GroupName=$request->groupname;
        $group->description=$request->description;
        $group->state=$request->state;
        $group->update();

        $grp_admin=GroupAdmin::where('user_id',Auth::id())->join('groups','groups.id','=','group_id')->get();
        return view('Groups.AdminGroups',compact('grp_admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        GroupAdmin::where('group_id',$id)->delete();
      
        GroupMember::where('group_id',$id)->delete();

        Post::where('group_id',$id)->delete();


        $group=group::find($id);
        $group=group::where('id',$id)->delete();

        
        $grp_admin=GroupAdmin::where('user_id',Auth::id())->join('groups','groups.id','=','group_id')->get();
        return view('Groups.AdminGroups',compact('grp_admin'));

    }

    public function myGroups(){

        $group_member=GroupMember::all();
        $members=[];

  
        foreach($group_member as $member){

            if($member->User_id==Auth::id()){
                
                array_push($members,$member->group_id);

            }

        }
      
        $groups=DB::table('groups')->whereIn('id',$members)->get();
     
        return view('Groups.MyGroups',compact('groups'));

    }

        public function PendingRequest(){

        $grp_admin=groupAdmin::where('user_id',Auth::id())->get()->pluck('group_id');

        $grp_members=GroupMember::where('requested',1)->whereIn('group_id',$grp_admin)
        ->join('users','users.id','=','User_id')->join('groups','groups.id','=','group_id')->get();
            
        return view('Groups.PendingRequest',compact('grp_members'));
        }

        public function JoinGroup($id){

        $grp_member=new GroupMember();

        $grp_member->user_id=Auth::id();
        $grp_member->group_id=$id;
        $grp_member->requested=1;
        $grp_member->save();


        $grp_admin=GroupAdmin::where('group_id',$id)->first();
        $group_admin_user_id=$grp_admin->user_id;


        $group_admin=User::where('id',$group_admin_user_id)->first();
        $grp_admin_email=$group_admin->email;


        Mail::to($grp_admin_email)->send(new SendMail());

        $groups = group::all();
        $user_groups=GroupMember::where('user_id',Auth::id())->get()->pluck('requested','group_id');
        return view('Groups.index',compact('groups','user_groups'));
     
 }

        public function accept($groupid,$usergroupid){

            
            $grpmmbr=GroupMember::where('User_id', $usergroupid)->where('group_id',$groupid)->update(array('requested' => 2));

            $grp_admin=groupAdmin::where('user_id',Auth::id())->get()->pluck('group_id');

            $grp_members=GroupMember::where('requested',1)->whereIn('group_id',$grp_admin)
            ->join('users','users.id','=','User_id')->join('groups','groups.id','=','group_id')->get();
                
            return view('Groups.PendingRequest',compact('grp_members'));
        }

        public function reject($groupid,$usergroupid){

            $grp_member=GroupMember::where('User_id',$usergroupid)->where('group_id',$groupid)->where('requested',1)->delete();

            $grp_admin=groupAdmin::where('user_id',Auth::id())->get()->pluck('group_id');

            $grp_members=GroupMember::where('requested',1)->whereIn('group_id',$grp_admin)
            ->join('users','users.id','=','User_id')->join('groups','groups.id','=','group_id')->get();
                
            return view('Groups.PendingRequest',compact('grp_members'));
        }

        public function AdminGroups(){

            $grp_admin=GroupAdmin::where('user_id',Auth::id())->join('groups','groups.id','=','group_id')->get();
             return view('Groups.AdminGroups',compact('grp_admin'));

        }


}
