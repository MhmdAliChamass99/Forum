<div class="text-center">
        @if($user->thumbnail==null)
        @if($user->gender== 'male')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic.jpg') }}" class="pic">
        @elseif($user->gender== 'female')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic-girl.jpg') }}" class="pic">
        @else<img src="{{ URL::asset('/Images/Other.png') }}" class="pic">
        @endif
        @else <img src="{{ URL::asset('/Images/'.$user->thumbnail) }}" class="pic">
        @endif
        <form action="{{'/profile/'.$user->id}}" method="get">

        <button type="submit" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger " 
        style="width:10%;">{{$user->name}}</button>
</form>
</div>