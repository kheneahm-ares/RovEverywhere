@if(Session::has('success'))
  <div class="alert alert-success" role="alert">
    <strong>Success:</strong> {{Session::get('success')}}
  </div>
@endif

@if(Session::has('nosuccess'))
  <div class="alert alert-danger" role="alert">
    <strong>Failure:</strong> {{Session::get('nosuccess')}}
  </div>
@endif
