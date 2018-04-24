@extends('layouts.app')
@section('content')
</style>
  <?php
    header_remove();
?>

<div class="col-md-12">
	@if ($choice==='none')
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::text(array('value' => $network)) }}
		{{ Form::close() }}
	@elseif ($choice==='wpa')
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::close() }}
		<h1>Run</h1>
	@else
		{{ Form::open(array('url' => '/network/edit/current')) }}
		{{ Form::close() }}
		<h1>Jump</h1>
	@endif
</div>
@endsection
