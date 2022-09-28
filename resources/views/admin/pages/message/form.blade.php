@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;


    $formInputAttr = config('zvn.template.form_input_readonly');
    $formLabelAttr = config('zvn.template.form_label');
    $form_textarea_readonly = config('zvn.template.form_textarea_readonly');

    $statusValue      = ['unread' => config('zvn.template.status.unread.name') , 'replied' => config('zvn.template.status.replied.name')];
    $inputHiddenID    = Form::hidden('id', @$item['id']);   

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],
        [
            'label'   => Form::label('phone', 'Phone', $formLabelAttr),
            'element' => Form::text('phone', @$item['phone'], $formInputAttr )
        ],
        [
            'label'   => Form::label('email', 'Email', $formLabelAttr),
            'element' => Form::text('email', @$item['email'], $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'label'   => Form::label('title', 'Title', $formLabelAttr),
            'element' => Form::text('title', @$item['title'], $formInputAttr )
        ],
        [
            'label'   => Form::label('message', 'Message', $formLabelAttr),
            'element' => Form::textarea('content', @$item['content'] , $form_textarea_readonly )
        ],

        [
            'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
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
                    
                        {!! FormTemplate::show($elements)  !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
