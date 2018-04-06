@extends('layouts.app')
@section('content')
  <?php
    header_remove();
?>
  <div class="col-md-12">
    <iframe src="http://192.168.12.1:5555" frameborder="1" align="middle" width="100%" height="550"></iframe>
  </div>
  <div class="col-md-4">
       <div class="well" style="">
         <div class="row" style="text-align:center">
           <h2>
             System Information
             <a id="refresh" href="#" class="btn btn-lg fas fa-sync">
             </a>
           </h2>
         </div>
         <hr />
         <div class="form-group row">
           <label style="text-align:right"  class="col-md-4 col-form-label">System Time:</label>
           <div class="col-md-8">
             <label style="color:green" id="systime">N/A</label>
           </div>
         </div>
         <div class="form-group row">
           <label style="text-align:right" class="col-md-4 col-form-label">Uptime:</label>
           <div class="col-md-8">
             <label style="color:green" id="uptime">N/A</label>
           </div>
         </div>
         <div class="form-group row">
           <label style="text-align:right"  class="col-md-4 col-form-label">CPU Usage:</label>
           <div class="col-md-8">
             <label style="color:green" id="cpu_usage">N/A</label>
           </div>
         </div>
         <div class="form-group row">
           <label style="text-align:right" class="col-md-4 col-form-label">Internet:</label>
           <div class="col-md-8">
             <label style="color:green" id="internet">N/A</label>
           </div>
         </div>
         <hr />
         <div class="row">
           <div class="col-md-6" style="padding-left: 45px;">
             <a href="#" id="restart" class="btn btn-warning btn-edit btn-block">
               Restart
             </a>
             {{--{!! Html::linkRoute('workouts.edit', 'Edit', array('id' => $workout->id), array('class' =>
                   'btn btn-primary btn-block'))!!}--}}
           </div>
           <div class="col-md-6" style="padding-right: 45px;">
             <a href="#" id="shutdown" class="btn btn-danger btn-edit btn-block">
               Shut Down
             </a>
           </div>
         </div>
         <hr />
         <div align="center">

         </div>
           {{--{!! Html::linkRoute('workouts.all', 'Show all workouts', array(), array('class' =>
                 'btn btn-md btn-block'))!!}--}}
       </div>
     </div>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $("#refresh").click(function(){
    $.ajax({
      type:'POST',
      url: '/system/refresh',
      success:function(data){
        console.log(data);
        $('#systime').text(data['systime']);
        $('#uptime').text(data['uptime']);
        $('#cpu_usage').text(data['cpu_usage']);
        $('#internet').text(data['internet']);
      }
    });
  });

  $("#restart").click(function(){
    var IsValidated = validateRestart();
    if(IsValidated){
      $.ajax({
        type:'POST',
        url: '/system/restart',
        success:function(data){
          console.log(data);
        }
      });
    }
  });
  $("#shutdown").click(function(){
    var IsValidated = validateShutdown();
    if(IsValidated){
      $.ajax({
        type:'POST',
        url: '/system/shutdown',
        success:function(data){
          console.log(data);
        }
      });
    }
  });
  function validateRestart(){
      return confirm("Are you sure you want to restart machine? ");
  }
  function validateShutdown(){
      return confirm("Are you sure you want to restart machine? ");
  }
</script>
@endsection
