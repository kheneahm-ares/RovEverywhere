@extends('layouts.app')

@section('content')

  <style>
    .liveStream{
      background:url('/images/loader.gif') center center no-repeat;
    }

    #forward{
      /* border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      border-top: solid;
      border-left: solid;
      border-right: solid; */
      position:absolute;
      right: 110px;
      bottom: 250px;
      padding-left: 10px;
      padding-right: 10px;
      padding-bottom: 10px;
      opacity: 0.5;


    }
    #left{
      /* border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      border-top: solid;
      border-left: solid;
      border-bottom: solid; */
      position:absolute;
      bottom: 165px;
      right: 193px;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-right: 25px;
      opacity: 0.5;

    }
    #pwm{
      border-radius: 10px;
      position:absolute;
      bottom: 180px;
      right: 105px;
      font-size: 30px;
      opacity: 0.5;

    }
    #right{
      /* border-top-right-radius: 25px;
      border-bottom-right-radius: 25px;
      border-top: solid;
      border-right: solid;
      border-bottom: solid; */
      position:absolute;
      bottom: 165px;
      right: 25px;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 25px;
      opacity: 0.5;

    }
    #reverse{
      /* border-bottom-left-radius: 25px;
      border-bottom-right-radius: 25px;
      border-bottom: solid;
      border-left: solid;
      border-right: solid; */
      position:absolute;
      right: 110px;
      bottom: 95px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;
      opacity: 0.5;



    }
    #panLeft {
      position:absolute;
      right: 150px;
      top: 50px;
      opacity: 0.5;
    }

    #panRight {
      position:absolute;
      right: 70px;
      top: 50px;
      opacity: 0.5;

    }
    #panTiltNeutral {
      position:absolute;
      right: 110px;
      top: 50px;
    }
    #tiltLeft {
      position: absolute;
      right: 110px;
      top: 10px;
      opacity: 0.5;

    }
    #tiltRight {
      position: absolute;
      right: 110px;
      top: 90px;
      opacity: 0.5;

    }

    #takepic{
      position: relative;
      left: 8px;
      top: -540px;
      opacity: 0.5;
    }

  </style>

<div class="container" >

    <div class="col-md-12">
      <iframe class="liveStream" src="http://192.168.12.1:9090/stream" frameborder="0" align="middle" width="100%" height="550" align="middle" scrolling="no"></iframe>
      <button id="takepic" class="fas fa-camera" style="font-size: 50px; width: 100px;" onclick="takePic()"></button>


      <a href="#" id="forward" ><img style="height: 60px; width: 60px;"src="/images/forward.png"></a>
      <a href="#" id="left" ><img style="height: 60px; width: 60px;"src="/images/left.png"></a>
      <input class="col-md-1" type="number" value="50" min="50" max="254" id="pwm">
      <a href="#" id="right" ><img style="height: 60px; width: 60px;"src="/images/right.png"></a>
      <a href="#" id="reverse" ><img style="height: 60px; width: 60px;"src="/images/reverse.png"></a>


      <a href="#" id="panLeft" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/left.png"></a>
      <a href="#" id="panTiltNeutral" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/neutral.png"></a>
      <a href="#" id="panRight" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/right.png"></a>
      <a href="#" id="tiltLeft" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/forward.png"></a>
      <a href="#" id="tiltRight" style="height: 35px; width: 35px"><img style="height: 25px"src="/images/reverse.png"></a>

    </div>
</div>
<br />


  <script>

  $(document).ready(function(){

//---------------  This section is used for calling moving functions on the camera. -------------//

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

      $("#panStop").click(function(){
        $.get('/panStop');
      });
      $("#panRight").on("mousedown", function() {
        $.ajax({
          url: 'panRight',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/panStop');
      });

      $("#panNeutral").on("mousedown", function() {
        $.ajax({
          url: 'panNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/panStop');
      });

      $("#panLeft").on("mousedown", function() {
        $.ajax({
          url: 'panLeft',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/panStop');
      });

//---------------  This section is used for calling tilting functions on the camera. -------------//

      $("#tiltStop").click(function(){
        $.get('/tiltStop');
      });
      $("#tiltLeft").on("mousedown", function() {
        $.ajax({
          url: 'tiltLeft',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/tiltStop');
      });

      $("#tiltNeutral").on("mousedown", function() {
        $.ajax({
          url: 'tiltNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/tiltStop');
      });

      $("#tiltRight").on("mousedown", function() {
        $.ajax({
          url: 'tiltRight',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      }).on('mouseup', function() {
        $.get('/tiltStop');
      });

//---------------  This section is used for showing the pwm value. -------------//
      function getPWM(){
          var _pwm = $("#pwm").val();
          //console.log(_pwm);

        return _pwm;
      }
  });


  function takePic(){
    console.log("animate");
  }



  </script>


@endsection
