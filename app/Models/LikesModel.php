<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\schedule;


class LikesModel extends Model
{
    use HasFactory;

    public function addLike($id,$instructor,$coursename)
    {
        $like=new LikesModel;
        $data=array('instructor'=>$instructor,"iduser"=>$id,"coursename"=>$coursename);
        $like->insert($data);
        $schedule=new schedule;
        $schedule->incrementLikes($coursename,$instructor);
    }

    public function getLikes($id)
    {
        $like=new LikesModel;
        $courses=$like->where('iduser','=',$id)->get();
        return $courses;
    }

    public function removeLike($id,$instructor,$coursename)
    {
        $like=new LikesModel;
        $like->where('coursename','LIKE','%'.$coursename.'%')->where('instructor','LIKE','%'.$instructor.'%')->where('iduser','=',$id)->delete();
        $schedule=new schedule;
        $schedule->decrementLikes($coursename,$instructor);
    }



}
