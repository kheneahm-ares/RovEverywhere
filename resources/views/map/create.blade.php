@extends('layouts.app')

@section('content')
<style>
  #map-canvas{
      width: 600px;
      height: 500px;
  }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvuPRT9TEk3uWyoC4-nIw7tOI-0wuhbvA&libraries=places"></script>

  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <div id="map-canvas"></div>
    </div>
    <div class="col-md-4 col-md-offset-3">
      <h1>Add Location to picture</h1>
        {!! Form::open(array('route' => 'map.store')) !!}

        Select Image to Upload
        <div class="input-group">
              <label class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse <input type="file" name="avatar" style="display: none;">
                  </span>
              </label>
              <input type="text" class="form-control create-workout" style="margin-top: 0px; width: 157px;" readonly>
          </div>

          {{ Form::label('title', 'Title')}}
          {{ Form::text('title', null, array('class' => 'form-control'))}}


          <div class="form-group">
            <label for="title">Map</label>
            <input type="text" class="form-control"id="searchmap" name="searchmap" />
          </div>

          <div class="form-group">
            <label for="lat">Latitude</label>
            <input type="text" class="form-control" name="lat" id="lat" />
          </div>
          <div class="form-group">
            <label for="lng">Longitude</label>
            <input type="text" class="form-control" name="lng" id="lng" />
          </div>

          <button class="col-md-offset-10 btn btn-md btn-primary">Save</button>
          {{Form::close()}}
    </div>

  </div>

  <script>
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center:{
            lat: 41.88,
            lng: -87.63
          },
          zoom: 15
    });

    var marker = new google.maps.Marker({
      position: {
        lat: 41.88,
        lng: -87.63
      },
      map: map,
      draggable: true
    });

    var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));


    //listener that changes marker to new position depending on new search
    google.maps.event.addListener(searchBox, 'places_changed', function(){
      var places = searchBox.getPlaces();
      var bounds = new google.maps.LatLngBounds();
      var i, place;

      for(i = 0; place=places[i]; i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location); //set the marker to a new position
      }

      map.fitBounds(bounds);
      map.setZoom(15);
    });

    //listener that changed lat and long depending on where the marker is dragged to
    google.maps.event.addListener(marker, 'position_changed', function(){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);
    });

  </script>
@endsection
