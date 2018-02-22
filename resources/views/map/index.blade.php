@extends('layouts.app')
@section('scripts')
  <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection
<style>
    /* The Modal (background) */
    .modals {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
</style>
@section('content')
  @include('partials._googlemaps')
<div class="col-md-4 col-md-offset-1">
  <div id="map-canvas"></div>
</div>
<div class="col-md-5 col-md-offset-1">
  <div class="panel panel-default">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>
            Name
          </th>
          <th>
            Address
          </th>
          <th>
            Date Uploaded
          </th>
          <th>
            Date Edited
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($picturesData as $picture)
          <tr onclick="toggleModal({{$picture->id}})">
            <td>
              {{$picture->name}}
            </td>
            <td>
              {{$picture->address}}
            </td>
            <td>
              {{$picture->created_at}}
            </td>
            <td>
              {{$picture->updated_at}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
  @foreach($picturesData as $picture)

      <div id="{{$picture->id}}" class="modals">

          <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <img src='{{asset("uploads/pictures/".$picture->path)}}' />
            </div>

    </div>
@endforeach


    <script>
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
      function toggleModal(id){
        // When the user clicks the button, open the modal
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
