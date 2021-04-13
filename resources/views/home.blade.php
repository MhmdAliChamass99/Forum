@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
    @if(isset($Groups))
    @foreach($Groups as $g)
    <div class="col-3">
        <div class="card card-grps" >
            <img src="/Images/groups.jpg" class="card-img-top " >
            <div class="card-body">
                <H3 class="card-text">  <a class="card-a" href="{{'/group/'. $g->id  }}">{{$g->GroupName}}</a></H3>
            </div>
        </div>
    </div>
@endforeach
@else
<p> No Groups</p>
@endif

    </div>
</div>


@endsection
