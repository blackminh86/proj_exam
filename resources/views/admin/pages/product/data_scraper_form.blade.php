@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
use App\Models\ProductCategory;

$productCategory = ProductCategory::withDepth()->where('id','>',1)->orderBy('_lft','asc')->get()->pluck('name_with_depth','id')->toArray();
$areaValue = Config::get('zvn.config.area');
$serviceValue = Config::get('zvn.config.service');
$category_id  = (isset($category_id)) ? $category_id : '' ;
@endphp

@section('content')
@include ('admin.templates.page_header', ['pageIndex' => false])
@include ('admin.templates.error')

@if(isset($notify) && $notify != '')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>{{ $notify }}</strong>
        </div>
    </div>
</div>
@endif
<div class="row">
    <input type="hidden" name="curentUrl" value="{{route($controllerName).'/'}}" />
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Form'])
            <div class="x_content">
                {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/data-scraper"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}

                <div class="form-group">
                    {{ Form::label('product_category_id','Category',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    {{ Form::select('category_id[]',$productCategory , $category_id ,['class'=>'form-control col-md-6 col-xs-12' , 'multiple'=>'' , 'style' => 'height: 250px'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('limit','Limit',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('limit',48,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('form','Form Page',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('form',1,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('to','To Page',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('to',1,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('area','Area',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('area',$areaValue,'stock_location=VN039' ,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('service','Service',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('service',$serviceValue,'' ,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{ Form::submit('Scrape',['class'=>'btn btn-success'])}} 
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@endsection