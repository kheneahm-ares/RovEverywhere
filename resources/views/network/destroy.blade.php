
@extends('layouts.app')
@section('content')
</style>
  <?php
    header_remove();
?>

<h1>Test</h1>
<div class="col-md-12">
{{ Form::open(array('url' => '/network/destroy/wipe')) }}
{{ Form::label("ssidLbl", "SSID") }}
<select name="ssid">
	@foreach ($ssids as $ssid)
		@foreach ($ssid as $sd)
			<option value={{ $sd }}>{{ $sd }}</option>
		@endforeach
	@endforeach
</select>
<br>
{{ Form::label("networktypeLbl", "Network Type") }}
{{ Form::select('networktype', array('none' => 'Unsecured', 'wpa-psk' => 'WPA PSK', 'mschapv2' => 'MSCHAPV2')) }}
<br>
{{ Form::submit("Delete") }}
{{ Form::close() }} 
</div>
@endsection
