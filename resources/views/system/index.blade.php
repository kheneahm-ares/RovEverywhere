@extends('layouts.app')
@section('content')
<style>
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #8eb4cb;
}

</style>
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
         <div class="form-group row" >
           <div class="col-md-8" class="table-responsive">
             <table class="table table-hover">
              <thead>
                <tr>
                  <th>IP Addr</th>
                  <th>MAC Addr</th>
                  <th>Brand</th>
                </tr>
              </thead>
              @php ($count = -1)
              @foreach($lines as $line)
              <tr>
              @php ($count += 1)
                <td>{{$ips[$count]}}</td>
                <td>{{$macs[$count]}}</td>
                <td>{{$brands[$count]}}</td>
              </tr>
              @endforeach
             </table>
           </div>
         </div>
         <hr />
         <div class="row">
           <div class="col-md-6" style="padding-left: 45px;">
             <a href="#" id="restart" class="btn btn-warning btn-block">
               Restart
             </a>
           </div>
           <div class="col-md-6" style="padding-right: 45px;">
             <a href="#" id="shutdown" class="btn btn-danger btn-block">
               Shut Down
             </a>
           </div>
         </div>
         <hr />
         <div class="row">
           <div class="col-md-12">
               <a id="restartNetwork" class="btn btn-default btn-block">
                 Restart Network
               </a>
           </div>
         </div>
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
        $('#uptime').text(data['uptime']);
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
