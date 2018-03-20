@extends('layouts.app')

@section('content')

  <style>
    .liveStream{
      background:url('images/loader.gif') center center no-repeat;
    }

    #forward{
      border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      border-top: solid;
      border-left: solid;
      border-right: solid;
      position:absolute;
      left: 215px;
      padding-left: 10px;
      padding-right: 10px;
      padding-bottom: 10px;


    }
    #left{
      border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      border-top: solid;
      border-left: solid;
      border-bottom: solid;
      position:absolute;
      top: 100px;
      left: 100px;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-right: 25px;
    }
    #pwm{
      border-radius: 10px;
      position:absolute;
      top: 125px;
      left: 215px;
      font-size: 35px;
    }
    #right{
      border-top-right-radius: 25px;
      border-bottom-right-radius: 25px;
      border-top: solid;
      border-right: solid;
      border-bottom: solid;
      position:absolute;
      top: 100px;
      left: 330px;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 25px;
    }
    #reverse{
      border-bottom-left-radius: 25px;
      border-bottom-right-radius: 25px;
      border-bottom: solid;
      border-left: solid;
      border-right: solid;
      position:absolute;
      top: 215px;
      left: 215px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;


    }
    #panLeft {
      position:absolute;
      left: -130px;
      top: 40px;
      opacity: 0.2;
    }

    #panRight {
      position:absolute;
      left: -50px;
      top: 40px;
      opacity: 0.2;

    }
    #panTiltNeutral {
      position:absolute;
      left: -90px;
      top: 40px;
    }
    #tiltLeft {
      position: absolute;
      left: -90px;
      opacity: 0.2;

    }
    #tiltRight {
      position: absolute;
      left: -90px;
      top: 80px;
      opacity: 0.2;

    }

    #takepic{
      position: relative;
      top: -480px;
      opacity: 0.2;
    }

  </style>

<div class="container" >

    <div class="col-md-7">
      <iframe class="liveStream" src="http://192.168.12.1:9090/stream" frameborder="0" align="middle" width="640" height="480" align="middle" scrolling="no"></iframe>
      <button id="takepic" class="fas fa-camera" style="font-size: 50px; width: 100px;" onclick="takePic()"></button>
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
    </div>
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


@endsection
