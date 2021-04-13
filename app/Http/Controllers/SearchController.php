<?php

namespace App\Http\Controllers;
use App\Models\group;
use DB;
use Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function getResults(Request $request)
    {
            $query=$request->input('query');

            if(!$query){
                return redirect()->route('home');
            }

            $usersarray=DB::table('users')->where('name','LIKE', "%{$query}%")->get();
            $users=[];
            foreach($usersarray as $u)
            {
                if($u->id!=Auth::user()->id)
                {
                    array_push($users, $u);
                }
            }
            return view('search.results',compact('users'));
    }
}
