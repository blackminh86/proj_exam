@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
$item = (isset($items['setting_social'])) ? json_decode($items['setting_social'] , true) : null;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');
$formCkeditor = config('zvn.template.form_ckeditor');
$formInputTagify = config('zvn.template.form_input_tagify');

$elements = [
[
'label' => Form::label('youtube', 'Youtube', $formLabelAttr),
'element' => Form::text('youtube', @$item['youtube'], $formInputAttr )
],
[
'label' => Form::label('zalo', 'Zalo', $formLabelAttr),
'element' => Form::text('zalo', @$item['zalo'], $formInputAttr )
],
[
'label' => Form::label('facebook', 'Facebook', $formLabelAttr),
'element' => Form::text('facebook', @$item['facebook'], $formInputAttr )
],
[
'element' => Form::submit('Save', ['class'=>'btn btn-success']),
'type' => "btn-submit"
]
]
@endphp
{{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
<!-- Hidden Input -->
{{ Form::hidden('type_setting', 'setting_social') }}
{!! FormTemplate::show($elements) !!}
{{ Form::close() }}
