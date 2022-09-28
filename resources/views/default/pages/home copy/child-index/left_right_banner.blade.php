@php 
$left  = (isset($left_banner[0]))? asset('images/banner/' . $left_banner[0]->thumb ) : asset('assets/images/banners/home-banner1.jpg') ;
$right = (isset($right_banner[0]))? asset('images/banner/'. $right_banner[0]->thumb ) : asset('assets/images/banners/home-banner2.jpg') ;
@endphp
<div class="wide-banners wow fadeInUp outer-bottom-xs">
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ $left }}" alt=""> </div>
            </div>
            <!-- /.wide-banner -->
        </div>
        <!-- /.col -->
        <div class="col-md-5 col-sm-5">
            <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ $right }}" alt=""> </div>
            </div>
            <!-- /.wide-banner -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>