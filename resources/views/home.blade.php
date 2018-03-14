@extends('layouts.app')
@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>


@endsection
@section('content')

    <div class="col-md-12">
      <div id="high-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>



<script>

Highcharts.chart('high-chart', {
    chart: {
        type: 'line'
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
