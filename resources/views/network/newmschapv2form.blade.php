@extends('layouts.app')
@section('content')
</style>

<div class="col-md-12">
{{ Form::open(array('url' => '/network/add/mschapv2')) }}

	{{ Form::label('ssidLbl', "ssid") }}
	{{ Form::text('ssid') }}
	<br>
	{{ Form::label('eapLbl', 'eap') }}
	{{ Form::text('eap') }}
	<br>
	{{ Form::label('identityLbl', 'identity') }}
	{{ Form::text('identity') }}
	<br>
	{{ Form::label('passwordLbl', 'password') }}
	{{ Form::password('password') }}
	<br>
	{{ Form::label('phase1Lbl', 'phase1') }}
	{{ Form::text('phase1') }}
	<br>
	{{ Form::label('phase2Lbl', 'phase2') }}
	{{ Form::text('phase2') }}
	<br>
	{{ Form::submit('Add') }}

{{ Form::close() }}
</div>
@endsection
