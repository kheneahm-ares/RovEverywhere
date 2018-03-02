@extends('layouts.app')
@section('content')
  @include('partials._googlemaps')
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="col-md-5">
    <br />

    <img src="{{asset("uploads/pictures/".$uploadedPicture->path)}}" id="imagePreview" alt="Preview Image" width="300px" height="200px" />
  </div>
  <div class="col-md-6">
    <h3>Edit Picture</h3>
    <hr />
    {!!Form::model($uploadedPicture, array('route' => array('map.update', $uploadedPicture->id), 'files' => true, 'method' => 'PUT'))!!}
      <div class="input-group">
          <label class="input-group-btn">
              <span class="btn btn-default btn-file">
                  Browse
                  <input class="form-control" id="path" style="display: none" name="path" type="file" value="{{$uploadedPicture->path}}">
              </span>
          </label>
          <br />
      </div>
      <br />

     <!--- make sure first paramater matches column in database -->
     {{Form::label('name', 'Name') }}
     {{Form::text('name', $uploadedPicture->name, array('class' => 'form-control'))}}
     {{Form::label('address', 'Address') }}
     {{Form::text('address', $uploadedPicture->address, array('class' => 'form-control'))}}
     {{Form::label('lat', 'Lat') }}
     {{Form::text('lat', $uploadedPicture->lat, array('class' => 'form-control'))}}
     {{Form::label('lng', 'Long') }}
     {{Form::text('lng', $uploadedPicture->lng, array('class' => 'form-control'))}}
      <br />
     <div class="pull-right">
       <button type="submit" name="button" class="btn btn-success btn-lg">
         Save
       </button>
    </div>

    {!!Form::close()!!} <!--- !! bc we are not echoing it out, just executing code -->

  </div>

  <script>
  var marker = new google.maps.Marker({
    position: {
      lat: 41.88,
      lng: -87.63
    }
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

    // map.fitBounds(bounds);
    // map.setZoom(15);
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
