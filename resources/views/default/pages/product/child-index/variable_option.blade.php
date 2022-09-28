<div class="stock-container info-container m-t-10">
    <div class="row">
        <div class="col-sm-2">
            <div class="stock-box">
                <span class="label">Variation :</span>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="stock-box">
                <span class="value" id="variable">None</span>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.stock-container -->
<div class="stock-container info-container m-t-10 ">
    @foreach ($item -> attribute as $key => $attribute)
    <div class="row">
        <div class="col-sm-2">
            <div class="stock-box">
                <span class="label"> {{ $attribute->name }} :</span>
            </div>
        </div>
        <div class="col-sm-9">
            @foreach ($item -> attributeProduct as $attributeProduct)
            @if($attributeProduct -> attribute_id == $attribute -> id)
            <button id="variable_{{ $attributeProduct-> id }}" type="button" onclick="clickVarition( {{$attributeProduct-> id}} )" class="btn btn-outline-secondary btn-attr" style="margin-bottom: 5px" name="attr-{{ $key }}" value="{{ $attributeProduct-> id }}">
                {{ $attributeProduct->value}}
            </button>
            @endif
            @endforeach
        </div>
    </div><!-- /.row -->
    @endforeach
    <!-- ON / OFF CART -->
    <input type="hidden" name="cart_url" value="{{ route('cart.store') }}">
    <input type="hidden" name="product_id" value="{{$item->id}}">
    <input type="hidden" name="variable_id" value="0">
    <input type="hidden" name="variable_name" value="none">
    <input type="hidden" name="variable_price" value="{{ $item->price }}">
    <input type="hidden" name="variable_url" value="{{ route($controllerName . '.ajax-variation-product') }}">
    <input type="hidden" name="total-attr" value="{{(isset($key)) ? $key + 1 : 0 }}">
    

</div>
