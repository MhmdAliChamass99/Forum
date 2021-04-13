@extends('layouts.app')

@section('content')

<style>
.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the "active" element to highlight the current page */
.topnav a.active {
  background-color: #2196F3;
  color: white;
}

/* Style the search box inside the navigation bar */
.topnav input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
}

/* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}

</style>

<form action="/PendingRequest" method="GET">
@csrf

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" >
  <thead>
    <tr>
      <th class="th-sm">Group Name
      </th>
      
      <th class="th-sm">UserName
      </th>

      <th class="th-sm">Actions
      </th>
    </tr>
  </thead>
  <tbody>

  @foreach($grp_members as $group)
    <tr>
        <td>{{$group->GroupName}}</td>
        <td>{{$group->firstName}}  {{$group->lastName}}</td>
        <td>
        <a href="{{'/accept/'.$group->id.'/'.$group->User_id}}" class="btn btn-success group-button">Accept</a>
        <a href="{{'/reject/'.$group->id.'/'.$group->User_id}}" class="btn btn-danger group-button">Reject</a>
        </td>
    </tr>
    @endforeach
</tbody>

</tfoot>
</table>

</form>


@endsection