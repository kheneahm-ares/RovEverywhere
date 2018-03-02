@extends('layouts.app')
@section('content')
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<div class="container">

  @foreach($snapshots as $snap )
    <div class="col-md-3">
      <img width="300px" height="300px" src="{{asset("uploads/pictures/".$snap->path)}}"/>
    </div>
  @endforeach



@endsection
