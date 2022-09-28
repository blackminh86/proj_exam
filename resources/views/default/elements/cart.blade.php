@php 
$cart = Session::get('cart') ;
$count = ($cart != null ) ? count($cart) : 0 ;
@endphp
<div class="dropdown dropdown-cart"> <a href="{{ route('cart.show') }}" class="lnk-cart">
        <div class="items-cart-inner">
            <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
            <div class="basket-item-count"><span class="count">{{ $count }}</span></div>
            <div class="total-price-basket"> <span class="lbl">my cart</span> <span class="total-price">
            </div>
        </div>
    </a>
</div>