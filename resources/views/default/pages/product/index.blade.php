@php 
$info = Session::get('info');
$title = (isset($info['title'])) ? $info['title'] : '' ;
@endphp
@extends('default.main')
@section('title')
{{ Str::limit(html_entity_decode($item->name),25) }} | {{ $title }}
@endsection
@section('content')
@include('default.block.breadcumb' , ['id' => $item->product_category_id] )
<div class='row single-product'>
@include('default.pages.product.child-index.sidebar')
    <div class='col-md-9'>
    @include('default.pages.product.child-index.detail_product')
    @include('default.pages.product.child-index.content_product')
    @include('default.pages.product.child-index.relating_product')
    </div><!-- /.col -->
    <div class="clearfix"></div>
</div><!-- /.row -->
@endsection
