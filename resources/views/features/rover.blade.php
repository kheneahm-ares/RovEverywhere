@extends('layouts.app')
@section('scripts')
  <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

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
      border-radius: 10px;
      left: 8px;
      top: -540px;
      opacity: 0.5;
    }
    #phrase{
      border-radius: 10px;
      position:absolute;
      bottom: 100px;
      left: 25px;
      font-size: 40px;
      opacity: 0.5;
      width: 40%;
      height: 60px;
    }
    #speak{
      border-radius: 10px;
      position:absolute;
      bottom: 100px;
      left: 482px;
      opacity: 0.5;
    }

  </style>

<div class="container" >

    <div class="col-md-12">
      <iframe class="liveStream" src="http://192.168.12.1:9090/stream" frameborder="0" align="middle" width="100%" height="550" align="middle" scrolling="no"></iframe>
      <button id="takepic" class="fas fa-camera" style="font-size: 50px; width: 100px;"></button>

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
      <input id="phrase" type="text" class="form-control" maxlength="25"/>
      <button id="speak" class="btn" style="font-size: 30px;">Speak</button>

      <input type="hidden" value="1500" id="freq">
      <input type="hidden" value="1400" id="tiltFreq">
    </div>

    <div id="confirmScreenshot" class="modals">

        <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h3 style="text-align:center;">Screenshot Taken!</h3>
          </div>

  </div>
</div>

<div class="container">
<select id="mp3Files">
<option value=""> </option>
  <?php
foreach (glob("/var/www/RovEverywhere/public/sounds/*.mp3") as $sounds ) {
    ?> <option value="<?php echo basename($sounds) ?>"> <?php echo basename($sounds) ?> </option> <?php
  }
  ?>
</select>

<a href="#" id="playSound" style="height: 35px; width: 35px" ><img style="height: 25px"src="/images/play.png"></a>
<a href="#" id="pauseSound" style="height: 35px; width: 35px" ><img style="height: 25px"src="/images/pause.png"></a>
</div>
<br />


  <script>

  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //-- Section for speaking ---------------//
    $("#speak").click(function(){
      var phrase = $("#phrase").val();
      $.ajax({
        url: '/features/speak/{phrase}',
        type: 'POST',
        data: {phrase: phrase},
        success: function(response){
          console.log(response);
        }

      });

    });

//---------------  This section is used for playing audio on the pi. -------------//


    $("#playSound").click(function() {
      $.ajax({
         url: '/features/playSound',
                         type: 'GET',
                         data: { mp3Files: getSelect() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
    });

    $("#pauseSound").click(function() {
      $.ajax({
         url: '/features/pauseSound',
                         type: 'GET',
                         data: { mp3Files: getSelect() },
                         success: function(response)
                         {
                             console.log(response);

                         }
         });
    });

//---------------  This section is used for calling moving functions on the camera. -------------//

      $("#stop").click(function(){
        $.get('/stop');
      });
      $("#takepic").click(function(){
        toggleModal("confirmScreenshot");
        $.get('/takePic');
      });
      $("#reverse").on("mousedown", function() {
        //console.log(_pwm + "hello");
       $.ajax({
         url: '/reverse/{pwm}',
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
         url: '/forward/{pwm}',
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
         url: '/left/{pwm}',
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
         url: '/right/{pwm}',
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

      $("#panLeft").on("click", function() {
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
            url: '/panMovement/{freq}',
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

      $("#panTiltNeutral").on("click", function() {
	$("#freq").val(1500);
	$.ajax({
          url: '/panTiltNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      });

      $("#panRight").on("click", function() {//get value of freq
        //if value +100 <= 1500 then proceed to go to ajax call
        //else
        var currFreq = parseInt($("#freq").val());
        var decFreq = currFreq - 100;
        console.log(decFreq);

        if(decFreq >= 600){
            //dynamically change the freq value
            $("#freq").val(decFreq);
            $.ajax({
            url: '/panMovement/{freq}',
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

      $("#tiltLeft").on("click", function() {
        //get value of freq
        //if value +100 <= 1500 then proceed to go to ajax call
        //else
        var currFreq = parseInt($("#tiltFreq").val());
        var incFreq = currFreq + 100;
        console.log(incFreq);

        if(incFreq <= 2400){
            //dynamically change the freq value
            $("#tiltFreq").val(incFreq);
            $.ajax({
            url: '/tiltMovement/{tiltFreq}',
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

      $("#panTiltNeutral").on("click", function() {
        $("#tiltFreq").val(1400);
        $.ajax({
          url: '/panTiltNeutral',
                        type: 'GET',
                        success: function(response)
                        {
                            console.log(response);
                        }

        });
      });

      $("#tiltRight").on("click", function() {
        //get value of freq
        //if value +100 <= 1500 then proceed to go to ajax call
        //else
        var currFreq = parseInt($("#tiltFreq").val());
        var decFreq = currFreq - 100;
        console.log(decFreq);

        if(decFreq >= 900){
            //dynamically change the freq value
            $("#tiltFreq").val(decFreq);
            $.ajax({
            url: '/tiltMovement/{tiltFreq}',
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

      function getSelect(){
          var _file = $("#mp3Files").val();

        return _file;
      }
  });

  function toggleModal(id){
    // When the user clicks the button, open the modal
    var modal = document.getElementById(id);
    var spans = document.getElementsByClassName("close");
    var modals = document.getElementsByClassName("modals");
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
