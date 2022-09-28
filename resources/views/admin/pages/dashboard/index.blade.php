
@php

$article =  $params['count_article'] ;
$category = $params['count_category'] ;
$menu     = $params['count_menu'] ;
$slider   = $params['count_slider'] ;
@endphp
@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row" style="display: inline-block;">
<div class="top_tiles">
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
<div class="tile-stats">
<div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
<div class="count">{{ $article }}</div>
<h3>Bài Viết</h3>
<p><a href="#">Xem chi tiết</a></p>
</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
<div class="tile-stats">
<div class="icon"><i class="fa fa-comments-o"></i></div>
<div class="count">{{ $category }}</div>
<h3>Danh Mục</h3>
<p><a href="#">Xem chi tiết</a></p>
</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
<div class="tile-stats">
<div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
<div class="count"> {{ $menu }} </div>
<h3>Menu</h3>
<p><a href="#">Xem chi tiết</a></p>
</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
<div class="tile-stats">
<div class="icon"><i class="fa fa-check-square-o"></i></div>
<div class="count"> {{ $slider }} </div>
<h3>Slider</h3>
<p><a href="#">Xem chi tiết</a></p>
</div>
</div>
</div>
</div>
@endsection