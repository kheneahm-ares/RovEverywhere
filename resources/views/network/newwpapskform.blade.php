@extends('layouts.app')
@section('content')
</style>
  <?php
    header_remove();
?>

<div class="col-md-12">
{{ Form::open(array('url' => '/network/add/wpapsk')) }}

	{{ Form::label('ssidLbl', "ssid") }}
	{{ Form::text('ssid') }}
	<br>
	{{ Form::label('pskLabel', 'password') }}
	{{ Form::password('psk') }}
	<br>
	{{ Form::submit('Add') }}

{{ Form::close() }} 
</div>
@endsection
