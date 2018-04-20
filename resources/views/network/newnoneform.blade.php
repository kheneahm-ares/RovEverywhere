@extends('layouts.app')
@section('content')
</style>
  <?php
    header_remove();
?>

<div class="col-md-12">
{{ Form::open(array('url' => '/network/add/none')) }}

	{{ Form::label('ssidLbl', "ssid") }}
	{{ Form::text('ssid') }}
	{{ Form::submit('Add') }}

{{ Form::close() }} 
</div>
@endsection
