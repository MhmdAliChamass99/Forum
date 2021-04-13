<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function LikeCount(Post $p)
    {
        return  $this->likes()->where('post_id',$p->id)->count();
    }
    public function Coments()
    {
        return  $this->hasMany(comment::class);
    }
    public function getComments(Post $p)
    {
        return  $this->Coments()->where('post_id',$p->id);
    }
    public function getcmt($id)
    {
        $cmt=comment::where('post_id',$id)->get();
        return $cmt;
    }
    public function addcomment($id,$text)
    {
        $cmt=new comment;
        $cmt->post_id->id=$id;
        $cmt->user_id=Auth::user()->id;
        $cmt->text=$text;
        $cmt->save();
    }
}
