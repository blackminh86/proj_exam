@php 
$info = Session::get('info');
$logo = $info['logo'] ;
@endphp
@include('default.elements.top_menu')
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo"> <a href="{{ route('home') }}"> <img src="{{ asset('images/setting/' . $logo) }}" alt="{{ $info['copyright'] }}"> </a> </div>
                <!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                @include('default.elements.search_box')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                @include('default.elements.cart')
            </div>
        </div>
    </div>
</div>
@include('default.elements.menu')