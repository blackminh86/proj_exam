@php 
use App\Models\Product ;
@endphp
@foreach($cart as $key => $item)
@php 
$product = Product::find($item['product_id']);
$image   = json_decode($product->images)[0]->image;
$url     = route('product.show',['slug'=> Str::slug($product->name) , 'id'=>$item['product_id']] );
$total   = $item['quantity'] * $item['price'];
@endphp
<tr id="row-{{ $key }}" data-id="{{ $key }}" name="row-cart">
    <td class="romove-item"><a href="javascript:removeCart('row-{{ $key }}')" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
    <td class="cart-image">
        <a class="entry-thumbnail" href="detail.html">
            @if($product->type == 'self')
            <img src="{{ asset('images/product' . $image) }}" alt="">
            @else
            <img src="{{ $image }}" alt="">
            @endif
        </a>
    </td>
    <td class="cart-product-name-info">
        <h4 class='cart-product-description'><a href="{{ $url }}">{{ html_entity_decode($product->name) }}</a></h4>

        <div class="cart-product-info">
            <span class="product-color">Product ID<span id="product_id-{{ $key }}">{{ $item['product_id']}}</span></span>
        </div>
        <div class="cart-product-info">
            <span class="product-color">Variable<span id="variable_name-{{ $key }}">{{ $item['variable_name']}}</span></span>
        </div>
        <div class="cart-product-info">
            <span class="product-color">Variable ID<span id="variable_id-{{ $key }}">{{ $item['variable_id']}}</span></span>
        </div>
    </td>
    <td class="cart-product-quantity">
        <div class="quant-input" data-id="{{ $key }}">
            <div class="arrows">
                <div class="arrow plus gradient" data-id="{{ $key }}"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                <div class="arrow minus gradient" data-id="{{ $key }}"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
            </div>
            <input type="text" value="{{ $item['quantity'] }}" id="quant-{{ $key }}">
        </div>
    </td>
    <td class="cart-product-sub-total"><span class="cart-sub-total-price" data-price="{{ $item['price'] }}" id="price-{{ $key }}">{{ $item['price'] }}</span></td>
    <td class="cart-product-grand-total"><span class="cart-grand-total-price" id="total-{{ $key }}" data-total="{{ $total  }}">{{ $total }}</span></td>
</tr>
@endforeach