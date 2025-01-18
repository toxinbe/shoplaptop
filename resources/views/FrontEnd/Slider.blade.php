
<div class="col-xl-9 col-lg-8 slider_box">
    <div class="slider-wrapper theme-default">
        <!-- Slider Background  Image Start-->
        <div id="slider" class="nivoSlider" style="height: 409px">
        	@foreach($slide as $sl)
            <a href="{{$sl->link}}" target="_blank"><img src="source/image/slide/{{$sl -> image}}" data-thumb="source/image/slide/{{$sl -> image}}" alt="" title="#htmlcaption" /></a>
           <!--  <a href="#" target="_blank"><img src="{{asset('source/assets/frontend/img/slider/2.jpg')}}" data-thumb="{{asset('source/assets/frontend/img/slider/2.jpg')}}" alt="" title="#htmlcaption2" /></a> -->
            @endforeach
        </div>
        <!-- Slider Background  Image Start-->
    </div>
</div>

