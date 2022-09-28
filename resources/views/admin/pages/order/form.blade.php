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
            'label'   => Form::label('order_no', 'Order.No', $formLabelAttr),
            'element' => Form::text('order_no', @$item['order_no'], $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'label'   => Form::label('grand_total', 'Grand Total', $formLabelAttr),
            'element' => Form::text('grand_total', @$item['grand_total'], $formInputAttr )
        ],
        [
            'label'   => Form::label('voucher_code', 'Voucher', $formLabelAttr),
            'element' => Form::text('voucher_code', @$item['voucher_code'], $formInputAttr )
        ],
        [
            'label'   => Form::label('customer_id', 'Customer Id', $formLabelAttr),
            'element' => Form::number('customer_id', @$item['customer_id'], $formInputAttr )
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
