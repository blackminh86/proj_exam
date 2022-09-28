@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
use App\Models\ArticleCategory;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');
$formCkeditor = config('zvn.template.form_ckeditor');
$statusValue = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
$itemsCategory = ArticleCategory::withDepth()->orderBy('_lft','asc')->get()->pluck('name_with_depth','id')->toArray();
$inputHiddenID = Form::hidden('id', @$item['id']);
$inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);


$elements = [
[
'label' => Form::label('name', 'Name', $formLabelAttr),
'element' => Form::text('name', @$item['name'], $formInputAttr )
],[
'label' => Form::label('content', 'Content', $formLabelAttr),
'element' => Form::textArea('content', @$item['content'], $formCkeditor )
],[
'label' => Form::label('status', 'Status', $formLabelAttr),
'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
],[
'label' => Form::label('article_category_id', 'Category', $formLabelAttr),
'element' => Form::select('article_category_id', $itemsCategory, @$item['article_category_id'], $formInputAttr)
],[
'label' => Form::label('thumb', 'Thumb', $formLabelAttr),
'element' => Form::file('thumb', $formInputAttr ),
'thumb' => (!empty(@$item['id'])) ? Template::showItemThumb($controllerName, @$item['thumb'], @$item['name']) : null ,
'type' => "thumb"
],[
'element' => $inputHiddenID . $inputHiddenThumb . Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
];
@endphp

@section('content')
@include ('admin.templates.page_header', ['pageIndex' => false])
@include ('admin.templates.error')

<div class="row">
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
                {!! FormTemplate::show($elements) !!}
                {{ Form::close() }}
            </div>
            <script>
                var options = {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                };
            </script>
            <script>
                CKEDITOR.replace('content', options);
            </script>

        </div>
    </div>
</div>
@endsection