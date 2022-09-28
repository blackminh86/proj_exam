@php 
$banner['slider'] = [] ; $banner['left_banner']=[] ; $banner['right_banner']=[] ; $banner['wide_banner']=[] ;
$items['new-product'] = [] ; $items['feature'] = [] ; $items['best-seller'] = [] ; $items['special-deal'] = [] ;
foreach($banners as $item){
    $banner[$item->type][] = $item ;
}
foreach($item_home as $item){
    $items[$item->display][] = $item ;
}
@endphp
@extends('default.main')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
        @include('default.pages.home.child-index.slider' , ['sliders' => $banner['slider']])
        @include('default.pages.home.child-index.info_box')
        @include('default.pages.home.child-index.new_product' , ['new_product' => $items['new-product'] ])
        @include('default.pages.home.child-index.left_right_banner' , ['left_banner' => $banner['left_banner'] ] ,  ['right_banner' => $banner['right_banner'] ] )
        @include('default.pages.home.child-index.featured_product' , ['feature' => $items['feature'] ])
        @include('default.pages.home.child-index.wide_banner'  , ['wide_banner' => $banner['wide_banner'] ])
        @include('default.pages.home.child-index.best_seller_product' , ['best_seller' => $items['best-seller'] ])
        @include('default.pages.home.child-index.latest_blog')
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
        @include('default.pages.home.child-index.hotdeal')
        @include('default.pages.home.child-index.special_deal' , ['special_deal' => $items['special-deal']])
        @include('default.pages.home.child-index.tag')
    </div>
    @endsection