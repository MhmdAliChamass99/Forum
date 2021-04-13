@extends('layouts.app')

@section('content')

<div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- <div class="card" style="height:80%;"> -->
                    <div class="card-header" id="x">
                      {{$group->GroupName}}
                      <button class="btn btn-primary" style="display:inline"> <a href="{{ '/Posts/createPost/'.$group->id }}"  style="color:white">Add New Post </a></button>
                    </div>
                    
                    @foreach($posts as $post)
                    <div class="card">
                    <div class="card-header" id="x" >
                    @if($post->user->thumbnail==null)
                    @if($post->user->gender== 'male')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic.jpg') }}" style="vertical-align: middle;width: 30px;height: 30px;border-radius: 50%;">
                    @elseif($post->user->gender== 'female')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic-girl.jpg') }}" style="vertical-align: middle;width: 30px;height: 30px;border-radius: 50%;">
                    @else<img src="{{ URL::asset('/Images/Other.png') }}" style="vertical-align: middle;width: 30px;height: 30px;border-radius: 50%;">
                    @endif
                    @else <img src="{{ URL::asset('/Images/'.$post->user->thumbnail) }}" style="vertical-align: middle;width: 30px;height: 30px;border-radius: 50%;">
                    @endif
                    <a href="{{'/profile/'.$post->user->id}}">
                    {{$post->user->name}}</a>
                    @if($post->user->id==Auth::user()->id)
                   
                    <form action="{{ url('Posts' , $post->id) }}" method="POST" style="display:inline;" >
                 {{ csrf_field() }}
                 {{ method_field('DELETE') }}
                <button class="btn btn-danger" style="display:inline;float:right;"><i class="fa fa-trash"></i></button>
              </form>
              <a href="{{ '/Posts/'. $post->id .'/edit' }}" >
            <button class="btn btn-primary"style="display:inline;float:right;" ><i class="fa fa-edit"></i></button>
              </a> 
              @endif
                    </div>

                    <div class="card-body" >
                    <p>{{$post->Status}}</p>
    <!-- <div style="height:500px;background-color:grey;">
        
        <a href="{{ '/Posts/'. $post->id .'/edit' }}" >
            <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
              </a> 
  </div> -->
  </div></div>
  <div class="col-md-12">
  <div class="list-unstyled list-inline">
  <div class="interaction" data-postid="{{$post->id}}">
              <!-- <form action="{{'/Like/'.$post->id}}" method="POST" >
                 {{ csrf_field() }} -->
                 
                 @if(Auth::user()->LikedThisPost($post))
                 <a href="#" class="like" style="float:left;">Liked&nbsp;</a>
                @else
                <a href="#" class="like" style="float:left;">Like &nbsp;</a>
                @endif
            
                <a id="counter">&nbsp;{{$post->LikeCount($post)}} {{"   Likes on this Post"}}</a>
                
                  <a class="btn btn-primary" data-toggle="collapse" href="#comments-{{$post->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" style="display:inline;">
                    comments
                  </a>
                
                <div class="collapse" id="comments-{{$post->id}}" >
                  <div class="card card-body" data-postid="{{$post->id}}">
                  <input type="text" style=" border:2px solid black;" 
                    placeholder="Add comment" id="input-{{$post->id}}"
                    />
                  <a href="#" class="addcmt btn btn-primary" >Add Comment</a>
                  
                    <ul id="menue-{{$post->id}}">
                    @foreach($post->getcmt($post->id) as $cmt)

                   
                    @if($cmt->user->id==Auth::user()->id)
                    <li>{{'YOU :'}}{{$cmt->text}}</li>
                    @else
                    <li>
                    <a href="{{'/profile/'.$cmt->user->id}}">{{$cmt->user->name}} 
                  </a>{{$cmt->text}}</li>
                    
                  @endif
                  
                    
                    @endforeach
                    </ul>
                    
                    

                  </div>
                </div>
              <!-- </form> -->
              </div>
               <br>   
  </div>
</div>

  
  <br>
    @endforeach
</div>
</div>
</div>

            <br><br>

@endsection
