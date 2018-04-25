@extends('layouts.app')
@section('content')
</style>

<div class="col-md-12">
	@if ($choice==='none')
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::hidden('nettype', $choice) }}
		{{ Form::hidden('ssid', $network) }}
		{{ Form::label('ssidLbl', 'SSID') }}
		{{ Form::text('ssidNew', $network) }}
		<br>
		{{ Form::submit('Change') }}
		{{ Form::close() }}
	@elseif ($choice==='wpa')
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::hidden('nettype', $choice) }}
		{{ Form::hidden('ssid', $network) }}
		{{ Form::hidden('psk', $psk) }}
		{{ Form::label('ssidLbl', 'SSID') }}
		{{ Form::text('ssidNew', $network) }}
		<br>
		{{ Form::label('pskLbl', 'Password') }}
		{{ Form::password('pskNew') }}
		<br>
		{{ Form::submit('Change') }}
		{{ Form::close() }}
	@else
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::hidden('nettype', $choice) }}
		{{ Form::hidden('ssid', $network) }}
		{{ Form::label('ssidLbl', 'SSID') }}
		{{ Form::text('ssidNew', $network) }}
		<br>
		{{ Form::label('eapLbl', 'EAP') }}
		{{ Form::text('eap', $eap) }}
		<br>
		{{ Form::label('identityLbl', 'Identity') }}
		{{ Form::text('identity', $identity) }}
		<br>
		{{ Form::label('passwordLbl', 'password') }}
		{{ Form::password('password') }}
		<br>
		{{ Form::label('phase1Lbl', 'phase1') }}
		{{ Form::text('phase1', $phase1) }}
		<br>
		{{ Form::label('phase2Lbl', 'phase2') }}
		{{ Form::text('phase2', $phase2) }}
		<br>
		{{ Form::submit('Change') }}
		{{ Form::close() }}
	@endif
</div>
@endsection
