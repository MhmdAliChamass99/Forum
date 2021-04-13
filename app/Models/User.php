<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'name',
        'gender',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User','friends','user_id','friend_id');
    }
    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User','friends','friend_id','user_id');
    }
    public function friends()
    {
        return  $this->friendsOfMine()->wherePivot('accepted',true)->get()->
        merge($this->belongsToMany('App\Models\User','friends','friend_id','user_id')->wherePivot('accepted',true)->get());
    }
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted',false)->get(); 
    }
    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted',false)->get(); 
    }
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count(); 
    }
    public function hasFriendRequestRecieved(User $user)
    {
        return (bool) $this->friendRequests()->where('id',$user->id)->count(); 
    }
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
            'accepted'=>true,
        ]);
    }
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id',$user->id)->count();
    }
    public function removeFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function declineFriendRequest(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
        public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function LikesOfMine()
    {
        return $this->belongsToMany('App\Models\User','likes','user_id','post_id');
    }
   
    public function LikedThisPost(Post $post)
    {
        return (bool) $this->LikesOfMine()->where('post_id',$post->id)->count();
    }
    public function Like(Post $post)
    {
        $this->LikesOfMine()->attach($post->id);
    }
    
}
