<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = new user();
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        
        return view('user.Friends')
        ->with('friends',$friends)
        ->with('requests',$requests);
    }
    public function getAdd($id)
    {
       
        $user=User::find($id);
        if(!$user)
        {
            return redirect()->route('home');
        }
        if(Auth::user()->hasFriendRequestPending($user)||$user->hasFriendRequestPending(Auth::user()))
        {
            return redirect('user.Friends')->with('info','Request still pending');
        }
        if(Auth::user()->isFriendWith($user))
        {
            return redirect('user.Friends')->with('info','already friends');
        }
        
        Auth::user()->addFriend($user);
        $friends = new user();
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        
        return view('user.Friends')
        ->with('friends',$friends)
        ->with('requests',$requests);
    }
    public function getAccept($id)
    {
       
        $user=User::find($id);
        
        if(!$user)
        {
            return redirect()->route('home');
        }
     
        if(!Auth::user()->hasFriendRequestRecieved($user))
        {
            return redirect()->route('home');
        }
        Auth::user()->acceptFriendRequest($user);
        $friends = new user();
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        
        return view('user.Friends')
        ->with('friends',$friends)
        ->with('requests',$requests);

    }
    public function decline($id)
    {
       
        $user=User::find($id);
       
        Auth::user()->declineFriendRequest($user);
        $friends = new user();
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        
        return view('user.Friends')
        ->with('friends',$friends)
        ->with('requests',$requests);

    }
    public function unfriend($id)
    {   
        $user=User::find($id);
        Auth::user()->removeFriend($user);
        $friends = new user();
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('user.Friends')
        ->with('friends',$friends)
        ->with('requests',$requests);
    }



}
