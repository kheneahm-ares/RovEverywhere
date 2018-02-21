@extends('layouts.app')
@section('scripts')
  <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection
@section('content')
  @include('partials._googlemaps')
  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <div id="map-canvas"></div>
    </div>

    <script>
      var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center:{
              lat: 41.88,
              lng: -87.63
            },
            zoom: 10
      });
    </script>

@endsection
