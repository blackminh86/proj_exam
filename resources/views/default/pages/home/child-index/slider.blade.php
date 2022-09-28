
<div id="hero">
    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        @if(count($sliders)>0)
        @foreach($sliders as $image)
        <div class="item" style="background-image: url( {{ asset('images/banner/' . $image->thumb) }} );">
            <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                    <!-- <div class="slider-header fadeInDown-1">Top Brands</div>
                    <div class="big-text fadeInDown-1"> New Collections </div>
                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span> </div> -->
                    <div class="button-holder fadeInDown-3"> <a href="{{ $image->link }}" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Click Now</a> </div>
                </div>
                <!-- /.caption -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endforeach
        @else
        <div class="item" style="background-image: url( {{ asset('assets/images/sliders/02.jpg')}} );">
            <!-- /.container-fluid -->
        </div>
        @endif
    </div>
    <!-- /.owl-carousel -->
</div>