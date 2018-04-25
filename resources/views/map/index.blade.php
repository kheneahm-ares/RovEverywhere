@extends('layouts.app')
@section('scripts')
  <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
  <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection
<style>
      table thead tr th{
        text-align: center;
      }
</style>
@section('content')
  @include('partials._googlemaps')
  @if(count($picturesData) > 0)
    <div class="col-md-12" style="margin-bottom: 50px;">
      <div id="map-canvas" style="width:100%"></div>
    </div>
    </div>
    <div id="pic_data" class="col-md-12">
      <div class="panel panel-default">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Address
              </th>
              <th>
                Date Taken
              </th>
              <th>
                Actions
              </th>
            </tr>
          </thead>
          <tbody style="text-align:center">
            @foreach($picturesData as $picture)
              <tr>
                <td onclick="return toggleModal({{$picture->id}}, {{$picture->lat}}, {{$picture->lng}})">
                  {{$picture->name}}
                </td>
                <td>
                  {{$picture->address}}
                </td>
                <td>
                  {{$picture->date_taken}}
                </td>
                <td style="width:200px; text-align:center">
                  {!!Form::open(array('route' => array('map.delete', $picture->id), 'method' => 'DELETE', 'onsubmit' => 'return validate()'))!!}
                    <div class="form-actions no-color">
                        <a href="{{route('map.details', $picture->id)}}" class="btn btn-default btn-xs" style="color: black;">
                          <i class="fa fa-eye" aria-hidden="true"></i> View
                        </a>
                        <a href="{{route('map.edit', $picture->id)}}"  class="btn btn-default btn-xs" style="color: black;">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                        </a>
                      <button type="submit" class="btn btn-default btn-xs" style="color: black;">
                          <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                      </button>
                    </div>
                {!!Form::close()!!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <div style="text-align:center;">
      <h3 style="color: red">No uploads</h3>
    </div>
    <div class="col-md-12">
      <div id="map-canvas" style="width:100%; height: 80%"></div>
    </div>
  @endif

  @foreach($picturesData as $picture)

      <div id="{{$picture->id}}" class="modals">

          <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <img style="max-width:600px; max-height: 600px;" src='{{asset("uploads/pictures/".$picture->path)}}' />
            </div>

    </div>
@endforeach


    <script>
    function validate(){
      return confirm("Are you sure you want to delete the picture?");

    }
    // Get the modal
    var modals = document.getElementsByClassName("modals");

    // Get the button that opens the modal
    var btns = document.getElementsByClassName("myBtns");

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center:{
            lat: 41.88,
            lng: -87.63
          },
          zoom: 10
    });


    $(document).ready(function(){

      //geolocation, infowindow
      // var infoWindow = new google.maps.InfoWindow;
      //
      // // Try HTML5 geolocation.
      // if (navigator.geolocation) {
      //   navigator.geolocation.getCurrentPosition(function(position) {
      //     var pos = {
      //       lat: position.coords.latitude,
      //       lng: position.coords.longitude
      //     };
      //
      //     infoWindow.setPosition(pos);
      //     infoWindow.setContent('Location found.');
      //     infoWindow.open(map);
      //     map.setCenter(pos);
      //     var image = {
            // url: "{{asset("images/roverMarker.png")}}",
      //       // This marker is 20 pixels wide by 32 pixels high.
      //      size: new google.maps.Size(50, 50)
      //     };
      //     var marker = new google.maps.Marker({
      //       position: {
      //         lat: pos.lat,
      //         lng: pos.lng
      //       },
      //       map: map,
      //       icon: image,
      //       animation: google.maps.Animation.DROP,
      //       draggable: false,
      //     });
      //
      //   }, function() {
      //     handleLocationError(true, infoWindow, map.getCenter());
      //   });
      // }
      // else {
      //   // Browser doesn't support Geolocation
      //   handleLocationError(false, infoWindow, map.getCenter());
      // }
      //
      //
      // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      //   infoWindow.setPosition(pos);
      //   infoWindow.setContent(browserHasGeolocation ?
      //                         'Error: The Geolocation service failed.' :
      //                         'Error: Your browser doesn\'t support geolocation.');
      //   infoWindow.open(map);
      // }


      @foreach($picturesData as $picture)
        var marker = new google.maps.Marker({
          position: {
            lat: {{$picture->lat}},
            lng: {{$picture->lng}}
          },
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: false,
        });
        marker.addListener('click', function(){

          // When the user clicks the button, open the modal
          var modal = document.getElementById("{{$picture->id}}");
          modal.style.display = "block";


          // When the user clicks on <span> (x), close the modal
          for (let i = 0; i < spans.length; i++) {
              spans[i].onclick = function () {
                  modals[i].style.display = "none";
              }
          }
        });
      @endforeach

    });
    function toggleModal(id, latitude, long){
      // When the user clicks the button, open the modal

      map.setCenter({lat: latitude, lng: long});
      map.setZoom(10);

      var modal = document.getElementById(id);
      modal.style.display = "block";
      // When the user clicks on <span> (x), close the modal
      for (let i = 0; i < spans.length; i++) {
          spans[i].onclick = function () {
              modals[i].style.display = "none";
          }
      }
    }

    </script>

@endsection
