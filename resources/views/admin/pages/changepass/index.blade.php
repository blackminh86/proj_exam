@extends('admin.main')
@section('content')
@include ('admin.templates.error')
@include ('admin.templates.zvn_notify')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');
@$item = null;
$elements = [
[
'label' => Form::label('old-password', 'Old Password', $formLabelAttr),
'element' => Form::password('old_password', @$item['old-password'], $formInputAttr )
],
[
'label' => Form::label('password', 'Password', $formLabelAttr),
'element' => Form::password('password', @$item['password'], $formInputAttr )
],
[
'label' => Form::label('password_confirmation', 'Confirm Password', $formLabelAttr),
'element' => Form::password('password_confirmation', @$item['password_confirmation'], $formInputAttr )
],
[
'element' => Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
];

@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Change Password</h3>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <h2>Tài khoản</h2>
        <div class="x_title"></div>
        <div class="x_content">
            {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
            <!-- Hidden Input -->
            {{-- Form::hidden('id', $id) --}}
            {!! FormTemplate::show($elements) !!}
            {{ Form::close() }}
        </div>
    </div>
    @endsection