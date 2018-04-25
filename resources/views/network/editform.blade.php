@extends('layouts.app')
@section('content')
</style>

<div class="col-md-12">
	<div class="col-md-6 col-md-offset-3">
		@if ($choice==='none')
			{{ Form::open(array('url' => '/network/edit/current', 'class' => 'form-horizontal')) }}
			{{ Form::hidden('nettype', $choice) }}
			{{ Form::hidden('ssid', $network) }}
			<div class=" form-group">
				{{ Form::label('ssidNew', "SSID",  array('class' => 'control-label')) }}
				{{ Form::text('ssidNew', $network, array('class' => 'form-control')) }}
			 </div>
			 <div class="form-group pull-right">
				 <button type="submit" name="button" class="btn btn-success btn-lg">
					 Change
				</button>
			 </div>
			<br />
			{{ Form::close() }}
		@elseif ($choice==='wpa')
			{{ Form::open(array('url' => '/network/edit/current', 'class' => 'form-horizontal')) }}
			{{ Form::hidden('nettype', $choice) }}
			{{ Form::hidden('ssid', $network) }}
			{{ Form::hidden('psk', $psk) }}
			<div class="form-group">
				{{ Form::label('ssidNew', 'SSID', array('class' => 'control-label')) }}
				{{ Form::text('ssidNew',  null, array('class' => 'form-control')) }}
			</div>
			<br />
			<div class="form-group">
				{{ Form::label('pskNew', 'Password', array('class' => 'control-label')) }}
				<input name="pskNew" type="password" class="form-control" id="psk">
			</div>
			<br />
			<div class="form-group pull-right">
				<button type="submit" name="button" class="btn btn-success btn-lg">
					Change
			 </button>
			</div>
			{{ Form::close() }}
		@else
			{{ Form::open(array('url' => '/network/edit/current', 'class' => 'form-horizontal')) }}
			{{ Form::hidden('nettype', $choice) }}
			{{ Form::hidden('ssid', $network) }}
			<div class="form-group">
					{{ Form::label('ssidNew', "SSID", array('class' => 'control-label')) }}
					{{ Form::text('ssidNew', $network,array('class' => 'form-control')) }}
			</div>
			<br />
			<div class="form-group">
				{{ Form::label('eap', 'EAP', array('class' => 'control-label')) }}
				{{ Form::text('eap', $eap,array('class' => 'form-control')) }}
			</div>
			<br />

			<div class="form-group">
				{{ Form::label('identity', 'Identity', array('class' => 'control-label')) }}
				{{ Form::text('identity', $identity,array('class' => 'form-control')) }}
			</div>
			<br />

			<div class="form-group">
				{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
				<input name="psk" type="password" class="form-control" id="psk">
			</div>
			<br />

			<div class="form-group">
				{{ Form::label('phase1', 'PHASE1', array('class' => 'control-label')) }}
				{{ Form::text('phase1', $phase1,array('class' => 'form-control')) }}
			</div>
			<br />

			<div class="form-group">
				{{ Form::label('phase2', 'PHASE2', array('class' => 'control-label')) }}
				{{ Form::text('phase2', $phase2, array('class' => 'form-control')) }}
			</div>
			<br />
			<div class="form-group pull-right">
				<button type="submit" name="button" class="btn btn-success btn-lg">
					Change
			 </button>
			</div>
			{{ Form::close() }}
		@endif


	</div>

</div>
@endsection
