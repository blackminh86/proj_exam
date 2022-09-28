@extends('admin.main')
@php
use App\Helpers\Template as Template;
$xhtmlButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'], $params['search']);
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
        <div class="x_panel">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href=" {{route('productCategory') }} ">Publish</a></li>
                <li role="presentation"><a href="{{route('productCategory/autoGeneratedForm') }} ">Auto Generated</a></li>
            </ul>
            @include('admin.templates.x_title', ['title' => 'Danh sách'])
            @include('admin.pages.product_category.list')
            {{--@livewire('admin.product-category-list' , ['items' => $items->toArray() , 'curentPage' => $items->currentPage() , 'table' => $table])--}}

        </div>
    </div>
</div>

@if ($items!=null && count($items) >> 0)
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