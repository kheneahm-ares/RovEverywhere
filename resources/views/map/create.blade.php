@extends('layouts.app')
@section('scripts')
  <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">

@endsection
@section('content')
  @if(count($errors)> 0)
  <div class="alert alert-warning" role="alert">
    <strong>Error:</strong>
    <ul>
    @foreach($errors->all() as $error)
      <li>
        {{$error}}
      </li>
    @endforeach
    </ul>
  </div>
@endif
  @include('partials._googlemaps')
  <div class="row">
    <div class="col-md-4 col-md-offset-1">
      <div id="map-canvas"></div>
    </div>
    <div class="col-md-4 col-md-offset-2">
      <h1>Add Location to Picture</h1>
        {!! Form::open(array('route' => 'map.store', 'data-parsley-validate' => '', 'files' => true, 'method' => 'POST')) !!}

        Select Image Path to Upload
        <div class="input-group">
              <label class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse
                      {!! Form::file('path', array('class' => 'form-control', 'id' => 'path', 'name' => 'path', 'style' => 'display: none')) !!}
                  </span>
              </label>
              <br />
          </div>
          <img src="" id="imagePreview" alt="Preview Image" width="300px" height="200px" />
          <br />

          {{ Form::label('name', 'Title')}}
          {{ Form::text('name', null, array('class' => 'form-control', 'required' => ''))}}


          <div class="form-group">
            <label for="title">Search Map</label>
            <input type="text" class="form-control" id="address" name="address" required/>
          </div>

          <div class="form-group">
            <label for="lat">Latitude</label>
            <input type="text" class="form-control" name="lat" id="lat" required/>
          </div>
          <div class="form-group">
            <label for="lng">Longitude</label>
            <input type="text" class="form-control" name="lng" id="lng" required/>
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
          zoom: 10
    });

    var marker = new google.maps.Marker({
      position: {
        lat: 41.88,
        lng: -87.63
      },
      map: map,
      draggable: true
    });

    var searchBox = new google.maps.places.Autocomplete(document.getElementById('address'));


    //listener that changes marker to new position depending on new search

    searchBox.addListener('place_changed', function(){
      console.log("hello");
      var place = searchBox.getPlace();
      var bounds = new google.maps.LatLngBounds();
      var i, place;

      // for(i = 0; place=places[i]; i++){
      //   bounds.extend(place.geometry.location);
      //   marker.setPosition(place.geometry.location); //set the marker to a new position
      // }
      bounds.extend(place.geometry.location);
      marker.setPosition(place.geometry.location);

      map.fitBounds(bounds);
      map.setZoom(15);
    });

    //listener that changed lat and long depending on where the marker is dragged to
    google.maps.event.addListener(marker, 'position_changed', function(){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);

        //get city
        var googleApiUrl = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true";

        $.ajax({
            url: googleApiUrl,
            type: "GET",
            success: function(msg){
              console.log(msg.results[0]["formatted_address"]);
              var address = msg.results[0]["formatted_address"];
              $('#address').val(address);
            }

        });
    });

    $('#path').change(function(){
    			readImgUrlAndPreview(this);
    			function readImgUrlAndPreview(input){
    				 if (input.files && input.files[0]) {
    			            var reader = new FileReader();
    			            reader.onload = function (e) {
    			                $('#imagePreview').attr('src', e.target.result);
    							}
    			          };
    			          reader.readAsDataURL(input.files[0]);
    			     }
    		});
  </script>
@endsection
