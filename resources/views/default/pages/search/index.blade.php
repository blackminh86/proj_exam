@section('title')
Search | {{ Str::limit(html_entity_decode(ucfirst($keyword)),25) }}
@endsection

@extends('default.main')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/">Home</a></li>
                <li>/ Search</li>  
                <li class="active">/ {{ ucfirst($keyword) }}</li>                  
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<div class='row'>
    <!-- <form id="ajax-form" name="ajax-form" method="GET" action="{{-- route($controllerName . '.ajax') --}}" accept-charset='UTF-8'>
        <input type="hidden" name="display" value="grid">
        <input type="hidden" name="category_id" value="{{$category_id}}">
        <input type="hidden" name="current_page" value='1'>
        <input type="hidden" name="price" value='position'>
        <input type="hidden" name="distancePrice" value='0'>
    </form> -->
    @include('default.pages.search.child-index.sidebar.category_sidebar')
    <div class='col-md-9'>,
        {{--@include('default.pages.search.child-index.banner')--}}
        <div class="clearfix filters-container m-t-10">
            @include('default.pages.search.child-index.filter')
        </div>
        <div class="search-result-container">
            <div id="myTabContent" class="tab-content category-list">
                @include('default.pages.search.child-index.content')
            </div>
        </div>
        <div class="clearfix filters-container">
            <div class="text-right">
                @include('default.block.pagination')
            </div>
        </div>
    </div>
</div>
@endsection