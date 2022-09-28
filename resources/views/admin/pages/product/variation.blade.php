@php
use App\Helpers\Form as FormTemplate;
@endphp
@foreach($variation as $key => $value)
<div class="form-group variation-product">
    <div class="col-md-2 col-sm-2 col-xs-2">
        <label for="name">{{$value->name}}</label>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
    {{ Form::text('variation_id['.$value->id.']',($value->price)*100,['class'=>'form-control format-price' ])}}
    </div>
    @livewire('admin.status-button', ['rowId' => $value->id , 'status' => $value->status , 'table' => 'variation_products'])
    {{--<span class="btn btn-danger btn-delete-variation" data-id="{{ $value->id }}">x</span>--}}
</div>
@endforeach
