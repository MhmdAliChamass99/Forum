<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class userController extends Controller
{
    //

    public function profile()
    {
        $id=Auth::id();
        $user=User::find($id);
        return view('user.details',compact('user'));
    }
    public function display($id)
    {
        $user=User::find($id);
        return view('user.Friend',compact('user'));
    }
    
    public function displayFriends()
    {
        $id=Auth::id();
        $user=User::find($id);
        return view('user.Friends',compact('user'));
    }
    public function editUser()
    {
        $id=Auth::id();
        $user=User::find($id);
        return view('user.edit',compact('user'));
    }
    public function update(Request $request)
    {
        $id=Auth::id();
        $user=User::find($id);
        $user->name=$request->name;
        $user->firstName=$request->firstName;
        $user->lastName=$request->lastName;
        $user->gender=$request->gender;

        $user->update();
        $user=User::find($id);
        return view('user.details',compact('user'));
    }
    public function upload(Request $request)
    {
        
        $image=$request->file('image');
        if(!$image->getClientOriginalExtension())
        {
            $user=User::find($id);
        return view('user.details',compact('user'));
        }
        $input['imagename']=time().'.'.$image->getClientOriginalExtension();
        $destination=public_path('\Images');
        $image->move ($destination,$input['imagename']);
        $id=Auth::id();
        $user=User::find($id);
        $user->thumbnail=$input['imagename'];
        $user->update();
        $user=User::find($id);
        return view('user.details',compact('user'));
    }

    public function deleteAccount(Request $request)
    {
        
        $id=Auth::id();
        $user=User::find($id);
        $user->delete();
        Auth::logout();
        return redirect('/login');
    }
}
