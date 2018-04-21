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
                <td onclick="toggleModal({{$picture->id}})">
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
    $(document).ready(function(){
      $("#hideshow").click(function(){
        if($("#pic_data").is(":visible")){
          $("#pic_data").hide( "slide", { direction: "right"  }, 600 );
          $("#map-canvas").animate({ width: 1200 }, 'slow');
          $(this).toggleClass('fa-angle-right fa-angle-left');

        }
        else{
          $("#pic_data").show( "slide", { direction: "right"  }, 600 );
          $("#map-canvas").animate({ width: 500 }, 'slow');
          $(this).toggleClass('fa-angle-left fa-angle-right');


        }
      });
    });
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
