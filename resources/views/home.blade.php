@extends('layouts.app')

@section('content')

  <style>

    #forward{
      border-style: solid;
      position:absolute;
      left: 230px;
    }
    #left{
      border-style: solid;
      position:absolute;
      top: 200px;
      left: 100px;
    }
    #stop{
      border-style: solid;
      position:absolute;
      top: 200px;
      left: 230px;
    }
    #right{
      border-style: solid;
      position:absolute;
      top: 200px;
      left: 380px;
    }
    #reverse{
      border-style: solid;
      position:absolute;
      top: 325px;
      left: 230px;

    }

  </style>

<div class="container">

    <div class="col-md-7">
      <iframe src="http://ENTER_YOUR_IP_HERE:9000/javascript_simple.html" frameborder="0" align="middle" width="640" height="480" align="middle" scrolling="no"></iframe>
    </div>

    <div class="col-md-5">
      <div class="row col-md-offset-4">
        <button style="height: 50px; width: 100px" onclick="lighton()"><img style="height: 40px"src="/images/lighton.png"></button>
        <button style="height: 50px; width: 100px" onclick="lightoff()"><img style="height: 35px"src="/images/lightoff.png"></button>
      </div>
      <br />
        <a href="#" id="forward" ><img style="height: 65px"src="/images/forward.png"></a>
        <a href="#" id="left" ><img style="height: 65px"src="/images/left.png"></a>
        <a href="#" id="stop" ><img style="height: 65px"src="/images/stop.png"></a>
        <a href="#" id="right" ><img style="height: 65px"src="/images/right.png"></a>
        <a href="#" id="reverse" ><img style="height: 65px"src="/images/reverse.png"></a>
    </div>
</div>


  <script>
  $(document).ready(function(){
      $("#reverse").on("mousedown", function() {
       $.get('/reverse');
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#forward").on("mousedown", function() {
       $.get('/forward');
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#left").on("mousedown", function() {
       $.get('/left');
       }).on('mouseup', function() {
       $.get('/stop');
      });
      $("#right").on("mousedown", function() {
       $.get('/right');
       }).on('mouseup', function() {
       $.get('/stop');
      });
  });
  </script>


@endsection
