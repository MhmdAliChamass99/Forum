@extends('layouts.app')

@section('content')
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="search form-control">


<table id="dtBasicExample" class="table table-striped table-bordered table-sm" >
  <thead>
    <tr>
      <th class="th-sm">Group Name
      </th>
      
      <th class="th-sm">
      </th>
    </tr>
  </thead>
  <tbody>
      @foreach($groups as $group)
    <tr>
        <td>{{$group->GroupName}}</td>
        @if(isset($user_groups[$group->id]) !=null)

          @if($user_groups[$group->id]==1)

            <td><h4><label class="label label-warning">Pending</button></label></h4>
            @elseif($user_groups[$group->id]==2)
            <td>
              <h4>
                <label class="label label-success">Joined</label>
              </h4>
            @else
            <td><button><a href="#" class="btn btn-secondary group-button">Join Group</a></button></td>
            @endif

        @else
         <td><button><a  href="{{'/group/JoinGroup/'.$group->id}}" class="btn btn-secondary group-button">Join Group</a></button></td>
         @endif
    </tr>

    @endforeach
  
  </tfoot>
</table>


@endsection