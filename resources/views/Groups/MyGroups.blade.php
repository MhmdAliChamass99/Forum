@extends('layouts.app')

@section('content')

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="search form-control">

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" >
  <thead>
    <tr>
      <th class="th-sm">Group Name
      </th>
      
    </tr>
  </thead>
  <tbody>
      @foreach($groups as $group)
    <tr>
        <td>{{$group->GroupName}}</td>
    </tr>

    @endforeach
  
</table>


@endsection
