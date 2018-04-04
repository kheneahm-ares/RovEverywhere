@extends('layouts.app')
@section('scripts')
  <script src="{{asset('bower_components/highcharts/highcharts.js')}}"></script>
  <script src="{{asset('bower_components/highcharts/modules/exporting.js')}}"></script>


@endsection
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
            <!-- Top part of the slider -->
            <div class="row">
                <div class="col-sm-12" id="carousel-bounding-box">
                    <div class="carousel slide" id="myCarousel" data-interval="2000">
                        <!-- Carousel items -->
                        <div class="carousel-inner">

                              <div class="active item" data-slide-number="0">
                                <div class="panel-info">
                                  <div class="panel-heading">
                                    Outside Temperature
                                    <a class="pull-right" href="#">More</a>
                                  </div>
                                  <div class="panel-body">

                                  </div>
                                </div>                                </div>


                              <div class="item" data-slide-number="1">
                                <div class="panel-info">
                                  <div class="panel-heading">
                                    Outside Temperature
                                    <a class="pull-right" href="#">More</a>
                                  </div>
                                  <div class="panel-body">

                                  </div>
                                </div>
                               </div>
                               <div class="item" data-slide-number="2">
                                 <div class="panel-info">
                                   <div class="panel-heading">
                                     Outside Temperature
                                     <a class="pull-right" href="#">More</a>
                                   </div>
                                   <div class="panel-body">
                                   </div>
                                 </div>
                                </div>
                        <!-- Carousel nav -->
                        <a style="opacity:0.0" class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="fas fa-arrow-left"></span>
                        </a>
                        <a style="opacity:0.0" class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
    <!--/Slider-->
</div>
<br />

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
