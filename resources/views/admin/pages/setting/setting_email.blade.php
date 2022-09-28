@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
$item = (isset($items['setting_email_acc'])) ? json_decode($items['setting_email_acc'] , true) : null;

$formInputAttr = config('zvn.template.form_input');
$formInputTagify = config('zvn.template.form_input_tagify');

$formLabelAttr = config('zvn.template.form_label');
$formCkeditor = config('zvn.template.form_ckeditor');
$elements_login = [
[
'label' => Form::label('user', 'Tài khoản', $formLabelAttr),
'element' => Form::text('user', @$item['user'], $formInputAttr )
],
[
'label' => Form::label('password', 'Mật khẩu', $formLabelAttr),
'element' => Form::text('password', @$item['password'], $formInputAttr )
],
[
'label' => Form::label('name', 'Name', $formLabelAttr),
'element' => Form::text('name', @$item['name'], $formInputAttr )
],
[
'element' => Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
] ;
/** BBC */
$item = (isset($items['setting_email_bcc'])) ? json_decode($items['setting_email_bcc'] , true) : null ;
$elements_bcc = [
[
'label' => Form::label('bcc', 'BCC', $formLabelAttr),
'element' => Form::textArea('bcc', @$item['bcc'], $formInputTagify)
],
[
'element' => Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
];
/** Title Reply */
$item = (isset($items['setting_email_title'])) ? json_decode($items['setting_email_title'] , true) : null ;
$elements_title = [
[
'label' => Form::label('title_contact', 'Title Contact', $formLabelAttr),
'element' => Form::text('title_contact', @$item['title_contact'], $formInputAttr)
],
[
'label' => Form::label('title_order', 'Title Order', $formLabelAttr),
'element' => Form::text('title_order', @$item['title_order'], $formInputAttr)
],
[
'element' => Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
];

@endphp
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
            {{ Form::hidden('type_setting', 'setting_email_acc') }}
            {!! FormTemplate::show($elements_login) !!}

            {{ Form::close() }}
        </div>
    </div>

    <div class="x_panel">
        <h2>BCC</h2>
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
            {{ Form::hidden('type_setting', 'setting_email_bcc') }}
            {!! FormTemplate::show($elements_bcc) !!}

            {{ Form::close() }}
        </div>
    </div>

    <div class="x_panel">
        <h2>TITLE REPLY</h2>
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
            {{ Form::hidden('type_setting', 'setting_email_title') }}
            {!! FormTemplate::show($elements_title) !!}

            {{ Form::close() }}
        </div>
    </div>
</div>
