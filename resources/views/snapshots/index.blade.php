@extends('layouts.app')
@section('content')
<style>
.hide-bullets {
    list-style:none;
    margin-left: -40px;
    margin-top:20px;
}

.thumbnail {
    padding: 0;
}

.carousel-inner>.item>img, .carousel-inner>.item>a>img {
    width: 100%;
    height: 400px;
}
</style>
<div class="container">
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-sm-6" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                  <?php $count = 0 ?>
                  @foreach($snapshots as $snap )
                    <li class="col-md-3">
                      <a class="img-thumbnail" id="carousel-selector-{{$count}}">
                        <img width="100px" height="100px" src="{{asset("snapshots/".$snap->path.".jpg")}}"/>
                      </a>
                    </li>
                    <?php $count++ ?>
                  @endforeach
                </ul>
            </div>
            <div class="col-sm-6">
                <div class="col-xs-12" id="slider">
                    <!-- Top part of the slider -->
                    <div class="row">
                        <div class="col-sm-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                  <?php $count = 0 ?>
                                  @foreach($snapshots as $snap )
                                    @if($count == 0)
                                      <div class="active item" data-slide-number="{{$count}}">
                                          <img src="{{asset("snapshots/".$snap->path.".jpg")}}">
                                        </div>
                                    
                                  @else
                                      <div class="item" data-slide-number="{{$count}}">
                                          <img  src="{{asset("snapshots/".$snap->path.".jpg")}}">
                                        </div>
                                    
                                  @endif


                                    <?php $count++ ?>
                                  @endforeach
                                <!-- Carousel nav -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="fas fa-arrow-left"></span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Slider-->
        </div>

    </div>
</div>

<script>
  $(document).ready(function(){
    //$('#myCarousel').carousel({
      //         interval: 5000
      // });

       //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click(function () {
	       var id_selector = $(this).attr("id");

           $('#myCarousel').carousel();
       try {
           var id = /-(\d+)$/.exec(id_selector)[1];
           console.log(id_selector, id);
           $('#myCarousel').carousel(parseInt(id));
       } catch (e) {
           console.log('Regex failed!', e);
       }
   });
       // When the carousel slides, auto update the text
       $('#myCarousel').on('slid.bs.carousel', function (e) {
                var id = $('.item.active').data('slide-number');
               $('#carousel-text').html($('#slide-content-'+id).html());
       });
  });
</script>


@endsection
