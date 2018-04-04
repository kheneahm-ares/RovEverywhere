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

    #detectimage{
      position: relative;
      left: 8px;
      top: -540px;
      opacity: 0.5;
    }
    #detectface{
      position: relative;
      left: 8px;
      top: -540px;
      opacity: 0.5;
    }
    tr>th, tr>td{
      text-align: center;
    }

  </style>

<div class="container" >

    <div class="col-md-12">
      <iframe class="liveStream" src="http://192.168.12.1:9090/stream" frameborder="0" align="middle" width="100%" height="550" align="middle" scrolling="no"></iframe>
      <a href="#results" id="detectimage" class="btn btn-md" style="font-size: 60px; width: 400px;" >
        <h2 id="label_text">Detect Image</h2>
      </a>
      <a href="#results" id="detectface" class="btn btn-md" style="font-size: 60px; width: 400px;" >
        <h2 id="face_text">Detect Face</h2>
      </a>

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
      <input type="hidden" value="1500" id="freq">
        <input type="hidden" value="1400" id="tiltFreq">
    </div>

    <div class="col-md-6 col-md-offset-3">
      <h1 style="text-align:center">Results</h1>
      <table class="table table-responsive table-bordered table-hover" id="results">
        <thead>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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
          alert("Can't do that");
        }
      });

      $("#detectimage").click(function(e){
        $("#label_text").text("Detecting Image...");
        $(this).addClass('disabled');
        $("#detectface").addClass('disabled');
        $.ajax({
          type:'POST',
          url: '/features/imagerecognition/detectimage',
          success:function(data){
            console.log(data);

            /*Clears and sets up table*/
            $("#results").html("");
            setUpTable();

            var head = '<tr><th>Label</th><th>Confidence %</th> </tr>';
            $("#results > thead").append(head);
            for(i = 0; i < data.length; i++){
              var newLabel = ''+
              '<tr>'+
               '<td>'+
                 data[i]["Name"]+
               '</td>'+
               '<td>'+
                 data[i]["Confidence"].toFixed(2)+
               '</td>'+
              '</tr>';

              $("#results > tbody").append(newLabel);


            }
          }
        });

        e.preventDefault();

        var position = $($(this).attr("href")).offset().top;


        //delays moving to table by 4 secs
        setTimeout(function(){
          $("body, html").animate({
            scrollTop: position
          });
          $("#label_text").text("Detect Image");
          $("#detectimage").removeClass('disabled');
          $("#detectface").removeClass('disabled');

        }, 4000);

      });


      $("#detectface").click(function(e){
        $("#face_text").text("Analyzing Face...");
        $(this).addClass('disabled');
        $("#detectimage").addClass('disabled');
        $.ajax({
          type:'POST',
          url: '/features/imagerecognition/detectface',
          success:function(data){
            console.log(data);

            /*Clears and sets up table*/
            $("#results").html("");
            setUpTable();

            var head = '<tr><th>Description</th><th>Value</th> </tr>';
            $("#results > thead").append(head);

            //have to manually append what we want
            var face_desc = '<tr><td> Is a face? ' +
             '</td><td> '+
             data[0]["Confidence"].toFixed(2) + ' % ';

            var gender_desc = '<tr><td> Male or Female? ' +
              '</td><td> '+
              data[0]["Gender"]["Value"] + ' ('+
              data[0]["Gender"]["Confidence"].toFixed(2) + ' %)</td></tr>';

            var emotion_desc = '<tr><td> Main Emotion: ' +
               '</td><td> '+
               data[0]["Emotions"][0]["Type"] + ' ( '+
               data[0]["Emotions"][0]["Confidence"].toFixed(2)+ ' %)</td></tr>';

            var beard_desc = '<tr><td> Has a beard? ' +
              '</td><td> '+
              data[0]["Beard"]["Value"] + ' ( '+
              data[0]["Beard"]["Confidence"].toFixed(2)+ ' %)</td></tr>';


            var ageRange = '<tr><td> Age Range' +
             '</td><td> '+
             data[0]["AgeRange"]["Low"] + ' - '+
             data[0]["AgeRange"]["High"]+ ' years old</td></tr>';

            $("#results > tbody").append(face_desc);
            $("#results > tbody").append(gender_desc);
            $("#results > tbody").append(ageRange);
            $("#results > tbody").append(emotion_desc);
            $("#results > tbody").append(beard_desc);






          }
        });

        e.preventDefault();

        var position = $($(this).attr("href")).offset().top;


        //delays moving to table by 4 secs
        setTimeout(function(){
          $("body, html").animate({
            scrollTop: position
          });
          $("#face_text").text("Detect Face");
          $("#detectface").removeClass('disabled');
          $("#detectimage").removeClass('disabled');
        }, 4000);




      });

  });

  function setUpTable(){
    var setup = "<thead></thead><tbody> </tbody>";
    $("#results").append(setup);
  }

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



</script>

@endsection
