@php 
$wide  = (isset($wide_banner[0])) ? asset('images/banner/' . $wide_banner[0]->thumb ) : asset('assets/images/banners/home-banner.jpg');
@endphp
<div class="wide-banners wow fadeInUp outer-bottom-xs">
    <div class="row">
        <div class="col-md-12">
            <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ $wide  }}" alt=""> </div>
                <div class="strip strip-text">
                    <div class="strip-inner">
                        <h2 class="text-right">New Mens Fashion<br>
                            <span class="shopping-needs">Save up to 40% off</span>
                        </h2>
                    </div>
                </div>
                <div class="new-label">
                    <div class="text">NEW</div>
                </div>
                <!-- /.new-label -->
            </div>
            <!-- /.wide-banner -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
</div>