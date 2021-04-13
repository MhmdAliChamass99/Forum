@extends('layouts.app')

@section('content')
<html>
<head>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css"  rel="stylesheet">  

  <script  src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
</head>
<form action="/adminUploadFile" class="dropzone">
@csrf
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>

@stop