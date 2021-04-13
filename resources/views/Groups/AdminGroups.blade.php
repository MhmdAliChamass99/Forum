@extends('layouts.app')

@section('content')


<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." class="search form-control">
<br>
<br>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" >
  <thead>
    <tr>
      <th class="th-sm">Group Name
      </th>

      <th class="th-sm">Group Description
      </th>
      
    </tr>
  </thead>
  <tbody>
      @foreach($grp_admin as $group)
    <tr>
        <td>{{$group->GroupName}}</td>
        <td>{{$group->description}}</td>
        <td><a href="{{ '/group/'. $group->id .'/edit' }}" >
            <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
              </a> 
              <form action="{{ url('group' , $group->id) }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                      <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
              </td>
    </tr>

    @endforeach
  
</table>

@endSection
