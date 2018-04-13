@extends('layouts.app')
@section('scripts')
  <script src="{{asset('bower_components/highcharts/highcharts.js')}}"></script>
  <script src="{{asset('bower_components/highcharts/modules/exporting.js')}}"></script>


@endsection
<style>
  #fahr_panel{
    color: white;
    font-size: 50px;
    background-color: #ff4d4d;
  }
  #inter_panel{
    color: white;
    font-size: 50px;
    background-color: #e6e600;
  }
  #humidity_panel{
    color: white;
    font-size: 50px;
    background-color: #3399ff;
  }
  .panel-heading{
    font-size: 12px;
  }
  .panel-body-temp{
    text-align: center;
  }
  .panel-body{
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;

  }
</style>
@section('content')

    <div class="col-md-12" style="margin-bottom: 50px;">
      <div id="high-chart" style=""></div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
          <div class="panel-heading">
            Recent Rover Activity
          </div>
          <div class="panel-body">
            @foreach ($activities as $ac)
              <p>
                @if($ac->type == "snapshot")
                  Took a snapshot at:
                @else
                  Uploaded at:
                @endif
                <label class="pull-right">
                  {{$ac->created_at}}
                </label>

              </p>

            @endforeach
          </div>
      </div>
    </div>
    <div class="col-md-6">
            <div class="col-md-4">
                <div class="panel-info">
                  <div class="panel-heading">
                    Outside Temperature
                  </div>
                  <div id="fahr_panel" class="panel-body panel-body-temp">
                    {{$fahr}}<span>&#176;</span> F
                    <br />
                    <label class="fas fa-cloud" style="font-size: 25px;"></label>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
              <div>
                <div class="panel-info">
                  <div class="panel-heading">
                    Outside Humidity
                  </div>
                  <div id="humidity_panel" class="panel-body panel-body-temp">
                    {{$humid}} %
                    <br />
                    <label class="fas fa-tint" style="font-size: 25px;"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div>
                <div class="panel-info">
                  <div class="panel-heading">
                    Internal Temperature
                  </div>
                  <div id="inter_panel" class="panel-body panel-body-temp">
                    {{$fahr}}<span>&#176;</span> F
                    <br />
                    <label class="fas fa-thermometer" style="font-size: 25px;"></label>
                  </div>
                </div>
              </div>
            </div>
  </div>
<script>


Highcharts.chart('high-chart', {
    chart: {
        type: 'area',
        backgroundColor: '#f0f0f0'
    },
    title: {
        text: 'Rover Activity'
    },
    subtitle: {
        text: 'Last 7 Days'
    },
    xAxis: {
        categories: [
                  "{{$dates[0]}}",
                  "{{$dates[1]}}",
                  "{{$dates[2]}}",
                  "{{$dates[3]}}",
                  "{{$dates[4]}}",
                  "{{$dates[5]}}",
                  "{{$dates[6]}}"
        ]
    },
    yAxis: {
        title: {
            text: 'Count'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series: [{
        name: 'Uploads',
        data: [
          {{$dateArray[$dates[0]]}},
                  {{$dateArray[$dates[1]]}},
                  {{$dateArray[$dates[2]]}},
                  {{$dateArray[$dates[3]]}},
                  {{$dateArray[$dates[4]]}},
                  {{$dateArray[$dates[5]]}},
                  {{$dateArray[$dates[6]]}}
        ]
    }, {
        name: 'Snapshots',
        data: [
          {{$snapshots[$dates[0]]}},
                  {{$snapshots[$dates[1]]}},
                  {{$snapshots[$dates[2]]}},
                  {{$snapshots[$dates[3]]}},
                  {{$snapshots[$dates[4]]}},
                  {{$snapshots[$dates[5]]}},
                  {{$snapshots[$dates[6]]}}
        ]
    }]
});
</script>
@endsection
