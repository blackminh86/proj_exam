@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
use App\Models\ProductCategory;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

$id = (isset ($item)) ? $item->id : $tempId  ;
$attrCategory = Attribute::select('*')->where('id','>',1)->pluck('name','id')->toArray() ;
$attrIdArray = [];
$attributes = [];

if(isset ($item)){
foreach($item->attributeProduct as $attribute){
$attributes[$attribute->attribute_id][] = ['value'=>$attribute->value];
}
$attrIdArray = collect($attributes)-> keys();
}

$statusValue = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
$productCategory = ProductCategory::withDepth()->where('id','>',1)->orderBy('_lft','asc')->get()->pluck('name_with_depth_with_id','_lft')->toArray();


$name = (isset ($item)) ? $item->name : null ;
$product_category_id = (isset ($item)) ? $item->product_category_id : 0 ;
$short_description =(isset ($item)) ? $item->short_description : null ;
$content = (isset ($item)) ? $item->content : null ;
$price = (isset ($item)) ? $item->price : null ;
$list_price = (isset ($item)) ? $item->list_price : null ;
$images = (isset ($item)) ? $item->images : null ; // json
$formInputTagify = config('zvn.template.form_input_tagify');

@endphp

@section('content')
@include ('admin.templates.page_header', ['pageIndex' => false])
@include ('admin.templates.error')

<div class="row">
    <input type="hidden" name="curentUrl" value="{{route($controllerName).'/'}}" />
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Form'])
            <div class="x_content">
                {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}

                {{ Form::hidden('attr_id_array' , json_encode($attrIdArray)) }}

                <div class="form-group">
                    {{ Form::label('name','Name',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('name',$name,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('list_price','List Price',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('list_price',$list_price*100,['class'=>'form-control col-md-6 col-xs-12 format-price'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('price','Promotional Pricing',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('price',$price*100,['class'=>'form-control col-md-6 col-xs-12 format-price'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('short_description','Desciption',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::textarea('short_description',$short_description,['class'=>'form-control col-md-6 col-xs-12 ckeditor','cols'=>50,'rows'=>10])}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('content','Content',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::textarea('content',$content,['class'=>'form-control col-md-6 col-xs-12 ckeditor','cols'=>50,'rows'=>10])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('status','Status',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('status',$statusValue,@$item->status ,['class'=>'form-control col-md-6 col-xs-12'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('product_category_id','Category',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) }}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @livewire('admin.select2-dropdown', ['list'=>$productCategory, 'categoryId' => $product_category_id , 'elementName'=>'product_category_id','elementId'=> '','type'=>'category' ])
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('thumb','Thumb',['class'=>'control-label col-md-3 col-sm-3 col-xs-6']) }}
                    <div class="input-group hdtuto control-group lst increment col-md-3 col-sm-3 col-xs-6">
                        <div class="list-input-hidden-upload">
                            <input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden">
                        </div>
                        <div class="input-group-btn col-md-3 col-sm-3 col-xs-12'">
                            <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i> Add image</button>
                        </div>
                    </div>
                    <div class="list-images col-md-offset-3 col-md-6 col-xs-12">
                        @if (isset($images) && !empty($images))
                        @foreach (json_decode($images) as $key => $img) 
                        <div class="box-image">
                            <input type="hidden" name="images_uploaded[]" value="{{ $img->image }}" id="img-{{ $key }}">
                            @if($item->type == 'scrape')
                            <img src='{{ $img->image }}' class="picture-box">
                            @else
                            <img src='{{ asset("images/$controllerName/". $img->image ) }}' class="picture-box">
                            @endif
                            
                            <input type="text" name="alt[]" value="{{ $img->alt }}" id="alt-{{ $key }}">
                            <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" class="btn-delete-image">x</span></div>
                        </div>
                        @endforeach
                        <input type="hidden" name="images_uploaded_origin" value="{{ $images  }}">
                        @endif
                    </div>
                    <input type="hidden" name="id" value="{{ $id }}">
                </div>
                
                <!-- Call Attribute & Attribute Product-->
                <div class="x_title">
                    <h2>Attribute</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-offset-3 attribute">
                @if(!isset($item->id))
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <span class="btn btn-success" id="add-attr">Add an attribute</span>
                            <span class="btn btn-primary invisible" id='save-attr'>Create Variation</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-2"><span class="label label-info">Type Of Attribute</span></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><span class="label label-info">Value Of Attribute</span></div>
                    </div>
                <!-- Call Attribute & Attribute Product End-->
                @else
                    @include('admin.pages.product.ajax_attribute' , ['id' => $id])
                @endif
                </div>
                <!-- Call Variation-->
                <div class="x_title">
                    <h2>Variation</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-offset-3 variation">
                    <!-- Ajax Variation -->
                    @if(isset($item->id))
                    @php 
                    $variation = DB::table('variation_products')->select('id' , 'name' , 'price', 'status',)->where('product_id' , $id)->get();
                    @endphp
                    @include('admin.pages.product.variation' , ['variation' => $variation])
                    @endif
                </div>

                <!-- Call Variation End-->

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{ Form::hidden('id',$id)}}
                        {{-- Form::hidden('thumb_current',$item->thumb)--}}
                        {{ Form::submit('Save & Publish',['class'=>'btn btn-success'])}}
                        {{ Form::button('Save Draft',['class'=>'btn btn-primary' , 'id' => 'save-draft'])}}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

</script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
</script>
<script>
    CKEDITOR.replace('content', options)
</script>


@endsection