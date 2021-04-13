@extends('layouts.app')

@section('content')
@foreach($users as $user)


@include('user/userblock');
@endforeach
@endsection
