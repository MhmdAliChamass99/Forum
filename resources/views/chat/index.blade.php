@extends('layouts.app2')

@section('content')

<div class="container">
    <chat :user="{{auth()->user()}}"></chat>
</div>
@endsection
