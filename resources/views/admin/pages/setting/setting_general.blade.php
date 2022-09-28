@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
$item = (isset($items['setting_general'])) ? json_decode($items['setting_general'] , true) : null;
$logo = (isset($item['logo'])) ? $item['logo'] : null ;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');
$formCkeditor = config('zvn.template.form_ckeditor');
$formInputTagify = config('zvn.template.form_input_tagify');

$elements = [
[
'label' => Form::label('logo', 'Logo', $formLabelAttr),
'element' => Form::file('logo', $formInputAttr ),
'thumb' => (!empty(@$item['logo'])) ? Template::showItemThumb($controllerName, @$item['logo'], @$item['name']) : null ,
'type' => "thumb"
],
[
'label' => Form::label('title', 'Title', $formLabelAttr),
'element' => Form::text('title', @$item['title'], $formInputAttr )
],
[
'label' => Form::label('hotline', 'Hotline', $formLabelAttr),
'element' => Form::hidden('hotline', @$item['hotline'], $formInputTagify )
],
[
'label' => Form::label('email', 'Email', $formLabelAttr),
'element' => Form::hidden('email', @$item['email'], $formInputTagify )
],
[
'label' => Form::label('copyright', 'Copyright', $formLabelAttr),
'element' => Form::text('copyright', @$item['copyright'], $formInputAttr )
],
[
'label' => Form::label('address', 'Địa chỉ', $formLabelAttr),
'element' => Form::text('address', @$item['address'], $formInputAttr )
],
[
'label' => Form::label('content', 'Content', $formLabelAttr),
'element' => Form::textarea('content', @$item['content'], $formCkeditor )
],
[
'label' => Form::label('url_map', 'Link Map', $formLabelAttr),
'element' => Form::text('url_map', @$item['url_map'], $formInputAttr )
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
{{ Form::hidden('type_setting', 'setting_general') }}
{{ Form::hidden('curent_logo', $logo  ) }}

{!! FormTemplate::show($elements) !!}

{{ Form::close() }}
