@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-4">
    {{-- the image --}}
    <img src="{{asset("uploads/pictures/".$picture->path)}}"/>
  </div>
  <div class="col-md-8">
    {{-- image details --}}
  </div>
</div>
@endsection
