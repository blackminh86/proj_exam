@extends('admin.main')
@php
use App\Helpers\Template as Template;
$xhtmlButtonFilter ='';
$activeIndex = '';
$activeDraft = 'active';
if(!isset($action) || $action != 'draft'){
    $xhtmlButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'], $params['search']);
    $activeIndex = 'active' ;
    $activeDraft = '';
}

$xhtmlAreaSeach = Template::showAreaSearch($controllerName, $params['search']);
@endphp

@section('content')

@include ('admin.templates.page_header', ['pageIndex' => true])
@include ('admin.templates.zvn_notify')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Bộ lọc'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-7">{!! $xhtmlButtonFilter !!}</div>
                    <div class="col-md-5">{!! $xhtmlAreaSeach !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
        
            <li role="presentation" class="{{ $activeIndex }}"><a href=" {{route('product') }} ">Publish</a></li>
            <li role="presentation" class="{{ $activeDraft }}"><a href="{{route('product/draft') }} ">Draft</a></li>
            <li role="presentation"><a href="{{route('product/data-scraper-form') }} ">Data Scraper</a></li>
        </ul>
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Danh sách'])
            @include('admin.pages.product.list')
        </div>
    </div>
</div>

@if (count($items) > 0)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Phân trang'])
            @include('admin.templates.pagination')
        </div>
    </div>
</div>
@endif
@endsection