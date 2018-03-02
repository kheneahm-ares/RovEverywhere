@extends('layouts.app')
<style>
  #details{
    padding-top: 10px;
    border: solid;
    border-color: gray;
  }
</style>
@section('content')
<div class="container">
  <div id="picture" class="col-md-7">
    {{-- the image --}}
    <img src="{{asset("uploads/pictures/".$picture->path)}}"/>
  </div>
  <div id="details" class="col-md-4 col-md-offset-1">
    {{-- image details --}}
    <div class="form-group">
      <label class="control-label">Name</label>
      <div>
        {{$picture->name}}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Address</label>
      <div>
        {{$picture->address}}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Lat/Long</label>
      <div>
        {{$picture->lat}}, {{$picture->lng}}

      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Date Uploaded</label>
      <div>
        {{$picture->created_at}}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Date Edited</label>
      <div>
        {{$picture->updated_at}}
      </div>
    </div>
    <div class="pull-right">
      <form method="POST">
        <a href="{{route('map.edit', $picture->id)}}" class="btn btn-warning btn-lg">Edit</a>

        <button type="submit" class="btn btn-danger btn-lg">
          Delete
        </button>
       </form>

    </div>
  </div>
</div>
@endsection
