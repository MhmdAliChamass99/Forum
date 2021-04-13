<?php

namespace App\Http\Controllers;
use App\Models\users;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function getProfile($id)
    {
        $user = User::find($id);
        if(!$user)
        {
            abort(404);
        }
        return view('Profile.index')->with('user',$user);
    }
}
