@extends('layouts.app')
@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>


@endsection
@section('content')

    <div class="col-md-12" style="margin-bottom: 50px;">
      <div id="high-chart" style=""></div>
    </div>

    <div class="col-md-5">
        <a href="#" id="forward" ><img style="height: 90px; width: 90px;"src="/images/forward.png"></a>
        <a href="#" id="left" ><img style="height: 90px; width: 90px;"src="/images/left.png"></a>
        <input class="col-md-3" type="number" value="50" min="50" max="254" id="pwm">
        <a href="#" id="right" ><img style="height: 90px; width: 90px;"src="/images/right.png"></a>
        <a href="#" id="reverse" ><img style="height: 90px; width: 90px;"src="/images/reverse.png"></a>


        <a href="#" id="panLeft" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/left.png"></a>
        <a href="#" id="panTiltNeutral" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/neutral.png"></a>
        <a href="#" id="panRight" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/right.png"></a>
        <input type="hidden" value="1500" id="freq">
        <input type="hidden" value="1500" id="tiltFreq">
        
        <a href="#" id="tiltLeft" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/forward.png"></a>
        <a href="#" id="tiltRight" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/reverse.png"></a>
    <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading">
            Recent Rover Activity
          </div>
          <div class="panel-body">
            Activty Stuff
          </div>
      </div>
    </div>
    <div class="col-md-6">
            <!-- Top part of the slider -->
            <div class="row">
                <div class="col-sm-12" id="carousel-bounding-box">
                    <div class="carousel slide" id="myCarousel" data-interval="2000">
                        <!-- Carousel items -->
                        <div class="carousel-inner">

                              <div class="active item" data-slide-number="0">
                                <div class="panel-info">
                                  <div class="panel-heading">
                                    Outside Temperature
                                    <a class="pull-right" href="#">More</a>
                                  </div>
                                  <div class="panel-body">

                                  </div>
                                </div>                                </div>


                              <div class="item" data-slide-number="1">
                                <div class="panel-info">
                                  <div class="panel-heading">
                                    Outside Temperature
                                    <a class="pull-right" href="#">More</a>
                                  </div>
                                  <div class="panel-body">

                                  </div>
                                </div>
                               </div>
                               <div class="item" data-slide-number="2">
                                 <div class="panel-info">
                                   <div class="panel-heading">
                                     Outside Temperature
                                     <a class="pull-right" href="#">More</a>
                                   </div>
                                   <div class="panel-body">
                                   </div>
                                 </div>
                                </div>
                        <!-- Carousel nav -->
                        <a style="opacity:0.0" class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="fas fa-arrow-left"></span>
                        </a>
                        <a style="opacity:0.0" class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
    <!--/Slider-->
</div>
<br />


  <script>

  $(document).ready(function(){

//---------------  This section is used for calling moving. -------------//

      $("#stop").click(function(){
        $.get('/stop');
      });
      $("#takepic").click(function(){
        $.get('/takePic');
      });
      $("#reverse").on("mousedown", function() {
        //console.log(_pwm + "hello");
       $.ajax({
         url: 'reverse/{pwm}',
                         type: 'GET',
                         data: { pwm: getPWM() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#forward").on("mousedown", function() {
        //console.log(_pwm);
       $.ajax({
         url: 'forward/{pwm}',
                         type: 'GET',
                         data: { pwm: getPWM() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#left").on("mousedown", function() {
        //console.log(_pwm);
       $.ajax({
         url: 'left/{pwm}',
                         type: 'GET',
                         data: { pwm: getPWM() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#right").on("mousedown", function() {
        // console.log(_pwm);
       $.ajax({
         url: 'right/{pwm}',
                         type: 'GET',
                         data: { pwm: getPWM() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
       }).on('mouseup', function() {
       $.get('/stop');
      });

//---------------  This section is used for calling panning functions on the camera. -------------//

      $("#panRight").on("mousedown", function() {
        //get value of freq 
        //if value +100 <= 1500 then proceed to go to ajax call
        //else 
        var currFreq = parseInt($("#freq").val());
        var incFreq = currFreq + 100;
        console.log(incFreq);

        if(incFreq <= 2500){
            //dynamically change the freq value
            $("#freq").val(incFreq);
            $.ajax({
            url: 'panMovement/ {freq}',
                          type: 'GET',
                          data: { freq: incFreq},
                          success: function(response)
                          {
                              console.log(response);
                          }
          });          
        }
        else{
          alert("Cant do that");
        }
      });

      $("#panTiltNeutral").on("mousedown", function() {
        $.ajax({
          url: 'panTiltNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      });

      $("#panLeft").on("mousedown", function() {//get value of freq 
        //if value +100 <= 1500 then proceed to go to ajax call
        //else 
        var currFreq = parseInt($("#freq").val());
        var decFreq = currFreq - 100;
        console.log(decFreq);

        if(decFreq >= 500){
            //dynamically change the freq value
            $("#freq").val(decFreq);
            $.ajax({
            url: 'panMovement/ {freq}',
                          type: 'GET',
                          data: { freq: decFreq},
                          success: function(response)
                          {
                              console.log(response);
                          }
          });          
        }
        else{
          alert("Cant do that");
        }
      });

//---------------  This section is used for calling tilting functions on the camera. -------------//

      $("#tiltStop").click(function(){
        $.get('/tiltStop');
      });
      $("#tiltLeft").on("mousedown", function() {
        //get value of freq 
        //if value +100 <= 1500 then proceed to go to ajax call
        //else 
        var currFreq = parseInt($("#tiltFreq").val());
        var incFreq = currFreq + 100;
        console.log(incFreq);

        if(incFreq <= 2500){
            //dynamically change the freq value
            $("#tiltFreq").val(incFreq);
            $.ajax({
            url: 'tiltMovement/ {tiltFreq}',
                          type: 'GET',
                          data: { freq: incFreq},
                          success: function(response)
                          {
                              console.log(response);
                          }
          });          
        }
        else{
          alert("Cant do that");
        }
      });

      $("#panTiltNeutral").on("mousedown", function() {
        $.ajax({
          url: 'panTiltNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      });

      $("#tiltRight").on("mousedown", function() {
        //get value of freq 
        //if value +100 <= 1500 then proceed to go to ajax call
        //else 
        var currFreq = parseInt($("#tiltFreq").val());
        var decFreq = currFreq - 100;
        console.log(decFreq);

        if(decFreq >= 500){
            //dynamically change the freq value
            $("#tiltFreq").val(decFreq);
            $.ajax({
            url: 'tiltMovement/ {tiltFreq}',
                          type: 'GET',
                          data: { freq: decFreq},
                          success: function(response)
                          {
                              console.log(response);
                          }
          });          
        }
        else{
          alert("Cant do that");
        }
      });

//---------------  This section is used for showing the pwm value. -------------//
      function getPWM(){
          var _pwm = $("#pwm").val();
          //console.log(_pwm);

        return _pwm;
      }

      function getFreq(){
          var _freq = $("#freq").val();
          //console.log(_pwm);

        return _freq;
      }
  });


  function takePic(){
    console.log("animate");
  }



  </script>


<script>


Highcharts.chart('high-chart', {
    chart: {
        type: 'area',
        backgroundColor: '#f0f0f0'
    },
    title: {
        text: 'Rover Activity'
    },
    subtitle: {
        text: 'Last 7 Days'
    },
    xAxis: {
        categories: [
                  "{{$dates[0]}}",
                  "{{$dates[1]}}",
                  "{{$dates[2]}}",
                  "{{$dates[3]}}",
                  "{{$dates[4]}}",
                  "{{$dates[5]}}",
                  "{{$dates[6]}}"
        ]
    },
    yAxis: {
        title: {
            text: 'Count'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series: [{
        name: 'Uploads',
        data: [
          {{$dateArray[$dates[0]]}},
                  {{$dateArray[$dates[1]]}},
                  {{$dateArray[$dates[2]]}},
                  {{$dateArray[$dates[3]]}},
                  {{$dateArray[$dates[4]]}},
                  {{$dateArray[$dates[5]]}},
                  {{$dateArray[$dates[6]]}}
        ]
    }, {
        name: 'Snapshots',
        data: [
          {{$snapshots[$dates[0]]}},
                  {{$snapshots[$dates[1]]}},
                  {{$snapshots[$dates[2]]}},
                  {{$snapshots[$dates[3]]}},
                  {{$snapshots[$dates[4]]}},
                  {{$snapshots[$dates[5]]}},
                  {{$snapshots[$dates[6]]}}
        ]
    }]
});
</script>
@endsection
